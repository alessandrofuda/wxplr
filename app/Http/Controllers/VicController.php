<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Order;


class VicController extends Controller {

	public function __construct(){
		$this->service_id = Service::VIC;
	}

    public function index(){

        $data['page_title'] = 'Career Ready';
        $data['payed'] = false;
        $data['price'] = Service::find($this->service_id)->price;
        $data['service_id'] = $this->service_id;

        if($this->paymentCheck($this->service_id)) {
            $data['payed'] = true;
        }
        
        return view('client.vic_intro', $data);
    }

    public function start() {

        if(!$this->paymentCheck($this->service_id)) {
            return back()->with('error', 'You have no order for this service!');
        }

        $data['page_title'] = 'Vic';

        return view('client.vic', $data);
    }

    public function middle() {
        return view('client.vic_middle');
    }

    public function completed() {
        return view('client.vic_completed');
    }

}
