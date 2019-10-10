<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Service;
use App\GotPro;
use App\Order;
use PDF;
use Auth;
use Session;

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

    public function gotProAlreadyCompletedCheck() {
        // !! IMPORTANTE:  manca a db l'informazione che indica se un flusso è stato COMPLETATO CORRETTAMENTE (fino in fondo), appena disponibile:inserirla !!!!
        $completed = GotPro::where('id_client', Auth::user()->id)->get();
        return count($completed) > 0 ?? null;
    }



    public function start() {

        if(!$this->paymentCheck($this->service_id)) {
            return back()->with('error', 'You have no order for this service!');
        }

        // sa ha già compilato redirect to completed // DA SISTEMARE NON APPENA AVREMO l'INFO A DB E-WHERE
        if($this->gotProAlreadyCompletedCheck()) {
            return redirect()->route('user.dashboard')->with('status', 'Got Pro already compiled'); 
        }


        
        $data['page_title'] = 'Got Pro';

        return view('client.got_pro', $data);
    }

    public function generateReport() {

        $got_pro_results = GotPro::where('id_client', Auth::user()->id);
        $got_pro_result = count($got_pro_results->get()) > 0 ? $got_pro_results->orderBy('crdate', 'DESC')->first() : null;

        if(!$got_pro_result) {
            return  back()->with('error', 'You haven\'t compiled Got PRO yet');
        }

        $data = [
            'meta_title' => 'GOT Pro Report',
            'title' => 'Global Orientation Test PRO - Report',
            'user_full_name' => Auth::user()->name.' '.Auth::user()->surname,
            'user_email' => Auth::user()->email,
            'birth_date' => $got_pro_result->birth_date,
            'gender' => $got_pro_result->gender,
            'study_level' => $got_pro_result->study_level,
            'work_function' => $got_pro_result->work_function,
            'work_sector' => $got_pro_result->work_sector,
            'work_level' => $got_pro_result->work_level,
            'country1' => $got_pro_result->country1,
            'country2' => $got_pro_result->country2,
            'country3' => $got_pro_result->country3,
            'crdate' => $got_pro_result->crdate,
        ];

        $pdf = PDF::loadView('reports.got-pro', $data);
        // return view('reports.got-pro', $data);
        // return $pdf->stream(); // load pdf in browser

        return $pdf->download('gotPro-report-'.Str::slug($data['user_full_name'], '-').'-'.date('Y-m-d').'-'.time().'.pdf');

    }



}
