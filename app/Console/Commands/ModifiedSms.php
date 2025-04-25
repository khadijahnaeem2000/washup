<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModifiedSms extends Command
{
    protected $signature = 'sms:modifedretry {order_id}';
    protected $description = 'Send Modified SMS for a specific order and retry if needed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
  
        $orderId = $this->argument('order_id'); // Get the order ID passed to the cron job
        
        Log::info("Starting SMS process for Order ID: {$orderId}");

        // Fetch the specific order
        $order = Order::find($orderId);

        if (!$order) {
            Log::error("Order ID: {$orderId} not found.");
            return;
        }

        if ($order->sms_sent) {
            Log::info("Order ID: {$orderId} already sent SMS. Skipping...");
            return;
        }

        $this->sendSmsWithModifiedRetries($order);
    }

    private function sendSmsWithModifiedRetries($order)
{
  
    $maxRetries = 2;

    for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
        try {
           

            $response = (new NotificationController)->send_modifiedsms($order->id);
    
            if ($response === true) { // ✅ Stop retrying if SMS is sent
                Log::info("✅ SMS sent successfully for Order ID: {$order->id} on attempt {$attempt}.");
                
                // ✅ Update the order in the database
                $order->update([
                    'sms_sent'            => true,
                    'sms_delivery_status' => "Success",
                    'sms_retry_count'     => $attempt,
                    'sms_failure_reason'  => null
                ]);

                Log::info("✅ Order updated successfully in DB for Order ID: {$order->id}.");

                return; // ✅ Exit function after successful SMS
            } else {
                Log::error("❌ SMS failed for Order ID: {$order->id} on attempt {$attempt}. Retrying...");

                // ❌ Update failure reason in the order table
                $order->update([
                    'sms_retry_count'     => $attempt,
                    'sms_delivery_status' => "Failed",
                    'sms_failure_reason'  => $response
                ]);
            }
        } catch (\Exception $e) {
            Log::error("⚠️ Error sending SMS for Order ID: {$order->id}. " . $e->getMessage());
        }
    }

    // ❌ If all retries failed, send an email to admin
    Log::error("🚨 SMS completely failed for Order ID: {$order->id} after 2 attempts. Notifying admin...");

    Mail::raw("SMS failed for Order ID: {$order->id} after 2 attempts. Reason: {$order->sms_failure_reason}", function ($message) use ($order) {
        $message->to('admin@washup.com')
            ->subject("🚨 SMS Failure Alert for Order ID: {$order->id}");
    });
}
}
