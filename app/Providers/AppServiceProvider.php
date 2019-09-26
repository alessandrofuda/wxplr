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

        \Braintree_Configuration::environment(config('services.braintree.environment'));
        \Braintree_Configuration::merchantId(config('services.braintree.merchant_id'));
        \Braintree_Configuration::publicKey(config('services.braintree.public_key'));
        \Braintree_Configuration::privateKey(config('services.braintree.private_key'));

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
