<?php

namespace App\Http\Controllers;

use App\MetaTags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Route;
use Session;
use App\Navigation;
use App\Setting;

class CustomBaseController extends Controller {
    
    public function __construct() {
        $current_route_name = Route::currentRouteName();
        if($current_route_name != 'client_register'  && $current_route_name != 'service_payment' && $current_route_name != 'payment_process' && $current_route_name != 'login' && $current_route_name != 'register' && $current_route_name != 'authLogin' && $current_route_name != 'authLoginPost'){
            // forget the session of the service used to get service info for payment
			Session::forget('login_redirect');
        }
        // share common variable to all views
        $navigation = Navigation::all();
        view()->share('navigation', $navigation);
        $settings=Setting::find(1);
        // $route = \Route::getCurrentRoute()->uri();
        $route = \Route::getCurrentRoute()->uri();
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

        if($tag == null) {
            $route = \Request::fullUrl();
            $tag = MetaTags::where('name',$route)->first();
        }

        view()->share('settings', $settings);
        view()->share('meta_tag', $tag);

    }
    
}
