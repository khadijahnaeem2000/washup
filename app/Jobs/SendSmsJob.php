<?php

namespace App\Jobs;



use App\Models\Order;
use App\Http\Controllers\NotificationController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle()
    {
        Log::info("📲 Starting SMS Job for Order ID: {$this->orderId}");

        $order = Order::find($this->orderId);
        if (!$order) {
            Log::error("❌ Order not found: ID {$this->orderId}");
            return;
        }

        if ($order->sms_sent) {
            Log::info("✅ SMS already sent for Order ID: {$this->orderId}. Skipping.");
            return;
        }

        $response = (new NotificationController)->send_sms($order->id);

        if (isset($response['status']) && $response['status'] === 'Success') {
            $order->update([
                'sms_sent'            => true,
                'sms_delivery_status' => 'Success',
                'sms_retry_count'     => 0,
                'sms_failure_reason'  => null
            ]);
            Log::info("✅ SMS sent successfully and order updated for ID: {$order->id}");
        } else {
            $order->update([
                'sms_delivery_status' => 'Failed',
                'sms_retry_count'     => 1,
                'sms_failure_reason'  => json_encode($response['response'] ?? 'Unknown error')
            ]);
            Log::error("❌ SMS failed for Order ID: {$order->id}. Will be retried automatically.");
            throw new \Exception("SMS failed: " . json_encode($response));
        }
    }
}



