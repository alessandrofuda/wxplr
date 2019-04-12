<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WowController extends Controller
{

	public function __construct(){
		$this->service_Id = 7;
	}


    public function index(){

    	// return view('client.wow');
    	return redirect('service/payment/'.$this->service_Id);

    }
}
