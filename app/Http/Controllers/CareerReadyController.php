<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;


class CareerReadyController extends Controller {

	public function __construct(){
		$this->service_Id = 6;
	}

    public function index(){

    	// payment check
    	$order = Order::where('user_id',\Auth::user()->id)->where('item_name','Career Ready')->first();
        if($order != null) {
            $data['page_title'] = 'Career Ready';
            return view('client.career_ready', $data);
        }

    	return redirect('service/payment/'.$this->service_Id);
    }
}
