<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config;
use Midtrans\Midtrans;
class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureMidtrans();
    }

    private function configureMidtrans(): void
    {
        Config::$isProduction = config('midtrans.is_production');
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
    }
}
