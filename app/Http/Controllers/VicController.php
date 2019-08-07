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
        
        return view('client.vic', $data);
    }

    public function start() {
        return 'ok';
    }

}
