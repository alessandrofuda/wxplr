<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerReadyController extends Controller
{

	public function __construct(){
		$this->service_Id = 6;
	}


    public function index(){

    	//return view('client.career_ready');
    	return redirect('service/payment/'.$this->service_Id);
    }
}
