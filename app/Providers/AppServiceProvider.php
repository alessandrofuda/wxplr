<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Navigation;
use App\Setting;
use App\Order;

class AppServiceProvider extends ServiceProvider {
	/**
    * Bootstrap any application services.
    *
    * @return void
    */
	public function boot() {

        \Braintree_Configuration::environment(env('BRAINTREE_ENV'));
        \Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        \Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        \Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));

		// Order::creating(function ($order) {
		//     if(!isset($order->invoice_number) || empty($order->invoice_number)) {
        //         $order->invoice_number = Order::getNextInvoiceNumber();
        //     }
        // });
	}
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
