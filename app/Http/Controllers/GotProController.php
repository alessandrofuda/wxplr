<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class GotProController extends Controller {

	public function __construct(){
		$this->service_Id = 5;
	}

    public function index(){

    	// payment check
    	$order = Order::where('user_id',\Auth::user()->id)->where('item_name','Global Orientation Test PRO')->first();
        if($order != null) {
            $data['page_title'] = 'Global Orientation Test PRO';
            return view('client.got_pro', $data);
        }

    	return redirect('service/payment/'.$this->service_Id);
    }
}
