<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Order;


class WowController extends Controller {

	public function __construct(){
		$this->service_id = Service::WOW;
	}

    public function index(){
        $data = ['page_title' => 'coming soon'];
        return view('client.wow', $data);

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
