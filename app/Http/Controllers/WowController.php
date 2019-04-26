<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class WowController extends Controller {

	public function __construct(){
		$this->service_Id = 7;
	}

    public function index(){

    	// payment check
    	$order = Order::where('user_id',\Auth::user()->id)->where('item_name','WOW')->first();
        if($order != null) {
            $data['page_title'] = 'WOW - Webinars';
            return view('client.wow', $data);
        }

    	return redirect('service/payment/'.$this->service_Id);

    }
}
