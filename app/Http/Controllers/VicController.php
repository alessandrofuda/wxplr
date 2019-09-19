<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\VicB2CMatrix;
use App\UserProfile;
use App\Service;
use App\VicB2C;
use App\Order;
use Auth;
use PDF;


class VicController extends Controller {

	public function __construct(){
		$this->service_id = Service::VIC;
	}

    public function index(){

        // sa ha già compilato redirect to completed // DA SISTEMARE NON APPENA AVREMO l'INFO A DB E-WHERE
        if($this->vicAlreadyCompletedCheck()) {
            return redirect()->route('vic_completed')->with('status', 'Vic already compiled');
        }

        $data['page_title'] = 'Career Ready';
        $data['payed'] = false;
        $data['price'] = Service::find($this->service_id)->price;
        $data['service_id'] = $this->service_id;

        if($this->paymentCheck($this->service_id)) {
            $data['payed'] = true;
        }
        
        return view('client.vic_intro', $data);
    }

    public function vicAlreadyCompletedCheck() {
        // !! IMPORTANTE:  manca a db l'informazione che indica se un flusso è stato COMPLETATO CORRETTAMENTE (fino in fondo), appena disponibile:inserirla !!!!
        $completed = VicB2C::where('IdUser', Auth::user()->id)->get();
        return count($completed) > 0 ?? null;
    }

    public function start() {

        if(!$this->paymentCheck($this->service_id)) {
            return back()->with('error', 'You have no order for this service!');
        }

        // !! inserire controllo: se l'utente ha già COMPLETATO la chat NON può rifarla. Se l'ha interrotta prima del completamento-> può riprenderla.

        $data['page_title'] = 'Vic';

        return view('client.vic', $data);
    }

    public function middle() {
        return view('client.vic_middle');
    }

    public function completed() {
        return view('client.vic_completed');
    }

    public function getResponseFromVicB2CChat($vic_b2c_current_user_chat, $IdQuestionResponse) {
        return $vic_b2c_current_user_chat->where('IdQuestionResponse', $IdQuestionResponse)->first()->Value ?? 'n.a.';
    }

    public function fetchPreparationReportData() {

        $vic_b2c_current_user_chat = VicB2C::where('IdUser', Auth::user()->id)->orderBy('crdate', 'DESC')->get(); //orderby DESC// attenzione!: l'utente DEVE POTER FARE UN'UNICA compilazione, inserire un controllo a inizio chat!!
        // !! nella tabella manca l'informazione per identificare la chat da cui prendere le informazioni. Es. userId:10 ha records che fanno riferimento a più chats.
        // se l'utente compila una e una sola volta la chat potrebbe non servire l'id sessione.

        if(count($vic_b2c_current_user_chat) == 0 || !$vic_b2c_current_user_chat) {
            return null;
        }
        
        $target_country = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, 'country');
        $target_country_id = VicB2CMatrix::where('paese', $target_country)->orderBy('Id', 'DESC')->first()->Id ?? null;
        $target_country_info = VicB2CMatrix::find($target_country_id); 
        $target_country_name = $target_country_info->paese ?? 'n.a.';
        $main_product_sectors = $target_country_info->Testo2_3_1_5 ?? 'n.a.';
        $your_selection_on_product_sectors = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '1_6'); 
        $geographic_area_where_you_move = $target_country_info->Testo2_3_1_7 ?? 'n.a.';
        $local_language_knowledge = $target_country_info->Testo2_3_1_9 ?? 'n.a.';
        $local_language_knowledge_level = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '1_10'); // valori da 1 a 5 dove dove 1 è “molto basica” e 5 è “fluente”

        /*your goal*/
        $goals = [
            '1' => 'Ho terminato/sto terminando gli studi e sto cercando la mia prima esperienza professionale',
            '2' => 'Vorrei fare un’esperienza di crescita all’estero',
            '3' => 'Sono insoddisfatto del mio attuale ruolo e vorrei aprirmi a nuove esperienze professionali',
            '4' => 'Soffro per la mancanza di opportunità nel mio paese',
            '5' => 'Altro',
        ];
        $your_goal_code = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_4');
        if($your_goal_code == '5' ) {
            $your_goal = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_4_altro'); 
        } else {
            $your_goal = $goals[$your_goal_code];
        }
        
        /*your motivation*/
        $motivations = [
            '1' => 'Crescere come persona e come professionista',
            '2' => 'Migliorare la qualità della vita per me e/o per la mia famiglia',
            '3' => 'Migliorare la mia situazione economica',
            '4' => 'Raggiungere un partner/familiare',
            '5' => 'Rientrare nel mio Paese dopo diversi anni all’estero senza fare passi indietro',
            '6' => 'Altro',
        ];
        $your_motivation_code = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_6');
        if($your_motivation_code == '6' ) {
            $your_motivation = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_6_altro');
        } else {
            $your_motivation = $motivations[$your_motivation_code];
        }
        
        /*your target role*/
        $target_role = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_8');

        /*sectors you can aim at*/
        $target_sector = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_10');

        /*In [paese] è [facile/difficile] spostarsi da un settore all'altro*/
        $modality = $target_country_info->modalita ?? 'n.a.';
        
        /*cultural fit*/
        $cultural_fit = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_13');

        /*gap/ostacoli*/
        $gaps = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_15');

        /*cv check*/
        //// non ci sono informazioni a database relative al cv check

        return compact('target_country_name', 'main_product_sectors', 'your_selection_on_product_sectors', 'geographic_area_where_you_move', 'local_language_knowledge', 'local_language_knowledge_level', 'your_goal', 'your_motivation', 'target_role', 'target_sector', 'modality', 'cultural_fit', 'gaps');
    }


    public function generatePreparationReport() {

        $data = $this->fetchPreparationReportData();
        if(!$data) {
            return  back()->with('error', 'You haven\'t compiled Vic yet');
        }

        $data['full_name'] = Auth::user()->name.' '.Auth::user()->surname;
        $data['name'] = Auth::user()->name;
        $data['origin_country'] = UserProfile::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first()->country ?? 'n.a.';
        $data['title'] = 'WELCOME IN WEXPLORE<br/>SBLOCCA IL POTENZIALE DELLA TUA CARRIERA';

        //dd($data);

        $pdf = PDF::loadView('reports.vic-b2c-preparation', $data);
        // return view('reports.vic-b2c-preparation', $data);
        // return $pdf->stream(); // load pdf in browser

        return $pdf->download('vic-b2c-preparation-report-'.Str::slug($data['full_name'], '-').'-'.date('Y-m-d').'-'.time().'.pdf');

    }


    public function generateJobHuntReport() {

        $data = $this->fetchPreparationReportData();
        if(!$data) {
            return  back()->with('error', 'You haven\'t compiled Vic yet');
        }

        $data['full_name'] = Auth::user()->name.' '.Auth::user()->surname;
        $data['name'] = Auth::user()->name;
        $data['origin_country'] = UserProfile::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first()->country ?? 'n.a.';
        $data['title'] = 'WELCOME IN WEXPLORE<br/>SBLOCCA IL POTENZIALE DELLA TUA CARRIERA';

        $pdf = PDF::loadView('reports.vic-b2c-job-hunt', $data);
        // return view('reports.vic-b2c-job-hunt', $data);
        // return $pdf->stream(); // load pdf in browser

        return $pdf->download('vic-b2c-job-hunt-report-'.Str::slug($data['full_name'], '-').'-'.date('Y-m-d').'-'.time().'.pdf');

    }





    public function generateTakeOffReport() {
        return 'work in progress';
    }

}
