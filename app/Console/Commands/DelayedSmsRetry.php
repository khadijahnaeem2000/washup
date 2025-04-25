<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DelayedSmsRetry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:delayed-retry {order_id}';
    protected $description = 'Delay SMS Retry by 30 seconds';

    /**
     * The console command description.
     *
     * @var string
     */


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        sleep(30);
        Artisan::call('sms:retry', ['order_id' => $this->argument('order_id')]);
     
    }
}
