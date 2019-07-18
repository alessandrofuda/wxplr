<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Order;


class CareerReadyController extends Controller {

	public function __construct(){
		$this->service_id = Service::VIC;
	}

    public function index(){

        $data['page_title'] = 'Career Ready';
        $data['payed'] = false;
        $data['price'] = Service::find($this->service_id)->price;
        $data['service_id'] = $this->service_id;

        // payment check
    	$order = Order::where('user_id',\Auth::user()->id)->where('item_name','Career Ready')->first();
        if($order != null) {
            $data['payed'] = true;
        }
        
        return view('client.career_ready', $data);
    }

}
