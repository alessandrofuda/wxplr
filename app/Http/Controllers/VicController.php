<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VicB2CMatrix;
use App\UserProfile;
use App\Service;
use App\VicB2C;
use App\Order;
use Auth;


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




    public function generatePreparationReport() {

        $vic_b2c_current_user_chat = VicB2C::where('IdUser', Auth::user()->id)->orderBy('crdate', 'DESC')->get(); //orderby DESC// attenzione!: l'utente DEVE POTER FARE UN'UNICA compilazione, inserire un controllo a inizio chat!!
        // !! nella tabella manca l'informazione per identificare la chat da cui prendere le informazioni. Es. userId:10 ha records che fanno riferimento a più chats.
        // se l'utente compila una e una sola volta la chat potrebbe non servire l'id sessione.


        $full_name = Auth::user()->name.' '.Auth::user()->surname;
        $name = Auth::user()->name;
        $origin_country = UserProfile::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first()->country ?? 'n.a.';
        

        /*///*/ $country_id = 4; // ???????? sistemare non appena comunicano dove prendere questa informazione per ora: 4 = Francia !!!!!!!
        


        $target_country_info = VicB2CMatrix::find($country_id); 
        dump($target_country_info);
        $target_country_name = $target_country_info->paese ?? 'n.a.';
        $main_product_sectors = $target_country_info->Testo2_3_1_5 ?? 'n.a.';
        $your_selection_on_product_sectors = $vic_b2c_current_user_chat->where('IdQuestionResponse', '1_6')->first()->Value ?? 'n.a.';
        $geographic_area_where_you_move = $target_country_info->Testo2_3_1_7 ?? 'n.a.';
        $local_language_knowledge = $target_country_info->Testo2_3_1_9 ?? 'n.a.';
        $local_language_knowledge_level = $vic_b2c_current_user_chat->where('IdQuestionResponse', '1_10')->first()->Value ?? 'n.a.';  // valori da 1 a 5 dove dove 1 è “molto basica” e 5 è “fluente”

        /*your goal*/
        $goals = [
            '1' => 'Ho terminato/sto terminando gli studi e sto cercando la mia prima esperienza professionale',
            '2' => 'Vorrei fare un’esperienza di crescita all’estero',
            '3' => 'Sono insoddisfatto del mio attuale ruolo e vorrei aprirmi a nuove esperienze professionali',
            '4' => 'Soffro per la mancanza di opportunità nel mio paese',
            '5' => 'Altro',
        ];
        $your_goal_code = $vic_b2c_current_user_chat->where('IdQuestionResponse', '2_4')->first()->Value ?? 'n.a.';
        if($your_goal_code == '5' ) {
            $your_goal = $vic_b2c_current_user_chat->where('IdQuestionResponse', '2_4_altro')->first()->Value ?? 'n.a.';
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
        $your_motivation_code = $vic_b2c_current_user_chat->where('IdQuestionResponse', '2_6')->first()->Value ?? 'n.a.';
        if($your_motivation_code == '6' ) {
            $your_motivation = $vic_b2c_current_user_chat->where('IdQuestionResponse', '2_6_altro')->first()->Value ?? 'n.a.';
        } else {
            $your_motivation = $motivations[$your_motivation_code];
        }
        
        /*your target roles*/
        
        
        


        return 'work in progress';
    }

    public function generateJobHuntReport() {
        return 'work in progress';
    }

    public function generateTakeOffReport() {
        return 'work in progress';
    }

}
