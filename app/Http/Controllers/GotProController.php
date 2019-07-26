<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Order;

class GotProController extends Controller {

	public function __construct(){
		$this->service_id = Service::GOT_PRO;
	}

    public function index(){
        $data['page_title'] = 'Got Pro';
        $data['payed'] = false;
        $data['price'] = Service::find($this->service_id)->price;
        $data['service_id'] = $this->service_id;

    	// payment check
    	$order = Order::where('user_id',\Auth::user()->id)->where('item_name','Global Orientation Test PRO')->first();
        if($order != null) {
            $data['payed'] = true;
        }

    	// return redirect('service/payment/'.$this->service_Id);
        return view('client.got_pro_intro', $data);
    }
}
