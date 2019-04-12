<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GotProController extends Controller {

	public function __construct(){
		$this->service_Id = 5;
	}

    public function index(){

    	// payment check
    	// if(Order::....),{
    	// 	return ....
    	// }

    	//return view('client.got_pro');
    	return redirect('service/payment/'.$this->service_Id);
    }
}
