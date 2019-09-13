<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\MetaTags;
use App\Setting;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {

        $settings=Setting::find(1);
        $route = \Route::getCurrentRoute()->uri();

        $path = \Request::fullUrl();

        $tag = MetaTags::where(\DB::raw('trim(name)'),$path)->first();
        if($tag == null) {
            $type = MetaTags::PAGE_TYPE_HOME;
            if($route == 'services') {
                $type = MetaTags::PAGE_TYPE_SERVICE;
            }
            if($route == 'about-us') {
                $type = MetaTags::PAGE_TYPE_ABOUT;
            }
            if($route == 'contact-us') {
                $type = MetaTags::PAGE_TYPE_CONTACT_US;
            }
            if($route == 'login') {
                $type = MetaTags::PAGE_TYPE_LOGIN;
            }
            $tag = MetaTags::where('page_type',$type)->first();
        }

        view()->share('settings', $settings);
        view()->share('meta_tag', $tag);


        /*$variable2 = 'I am Data 2';
        View::share ( 'variable1', $this->variable1 );
        View::share ( 'variable2', $variable2 );
        View::share ( 'variable3', 'I am Data 3' );
        View::share ( 'variable4', ['name'=>'Franky'] );*/
    }

    public function paymentCheck($serviceId) {
        $order = Order::where('user_id',Auth::user()->id)->where('item_id', $serviceId)->first();
        return $order ?? null;
    }


}
