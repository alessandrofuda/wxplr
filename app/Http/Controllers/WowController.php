<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class WowController extends Controller {

	public function __construct(){
		$this->service_id = Service::WOW;
	}

    public function index(){

        if($this->paymentCheck($this->service_id)) {
            $data['page_title'] = 'WOW - Webinars';
            return view('client.wow', $data);
        }

    	return redirect('service/payment/'.$this->service_Id);

    }

    public function start() {
        return 'ok';
    }
}
