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

        if($this->paymentCheck($this->service_id)) {
            $data['payed'] = true;
        }

        return view('client.got_pro_intro', $data);
    }

    public function start() {

        if(!$this->paymentCheck($this->service_id)) {
            return back()->with('error', 'You have no order for this service!');
        }
        
        $data['page_title'] = 'Got Pro';

        return view('client.got_pro', $data);
    }

}
