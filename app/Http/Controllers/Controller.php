<?php

namespace App\Http\Controllers;

use Auth;
use App\Order;
use App\VicB2C;
use App\Setting;
use App\MetaTags;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user_chats;

    public function __construct() {
        if(Auth::check()) {
            $this->user_chats = VicB2C::where('IdUser', Auth::user()->id)->get();
        } else {
            return redirect()->route('login')->with('error', 'You are logged out, please enter your login credentials and go next');
        } 
        
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
    }


    public function paymentCheck($serviceId) {
        $order = Order::where('user_id',Auth::user()->id)->where('item_id', $serviceId)->first();
        return $order ?? null;
    }

    public function vicInterruptedCheck() {
        if(count($this->user_chats) === 0 ){
            return null;
        }
        $last_session_id = $this->user_chats->where('IdQuestionResponse', 'start')->sortByDesc('crdate')->first()->Value ?? null;
        $completed = $this->user_chats->where('IdQuestionResponse', 'completed')->where('Value', $last_session_id);
        return count($completed) === 0 ?? null;
    }

    public function vicAlreadyCompletedCheck() {
        $last_session_id = $this->user_chats->where('IdQuestionResponse', 'start')->sortByDesc('crdate')->first()->Value ?? null;
        $completed = $this->user_chats->where('IdQuestionResponse', 'completed')->where('Value', $last_session_id);
        return count($completed) > 0 ?? null;
    }


}
