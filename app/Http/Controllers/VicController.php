<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\VicB2CMatrix;
use App\VicB2CScore;
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
        return $vic_b2c_current_user_chat->where('IdQuestionResponse', $IdQuestionResponse)->first()->Value ?? null;
    }

    public function fetchReportsData() {

        $vic_b2c_current_user_chat = VicB2C::where('IdUser', Auth::user()->id)->orderBy('crdate', 'DESC')->get(); //orderby DESC// attenzione!: l'utente DEVE POTER FARE UN'UNICA compilazione, inserire un controllo a inizio chat!!
        // !! nella tabella manca l'informazione per identificare la chat da cui prendere le informazioni. Es. userId:10 ha records che fanno riferimento a più chats.
        // se l'utente compila una e una sola volta la chat potrebbe non servire l'id sessione.

        if(count($vic_b2c_current_user_chat) == 0 || !$vic_b2c_current_user_chat) {
            return null;
        }
        
        $target_country = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, 'country') ?? 'n.a.';
        $target_country_id = VicB2CMatrix::where('paese', $target_country)->orderBy('Id', 'DESC')->first()->Id ?? null;
        $target_country_info = VicB2CMatrix::find($target_country_id); 
        $target_country_name = $target_country_info->paese ?? 'n.a.';
        $main_product_sectors = $target_country_info->Testo2_3_1_5 ?? 'n.a.';
        $your_selection_on_product_sectors = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '1_6') ?? 'n.a.'; 
        $geographic_area_where_you_move = $target_country_info->Testo2_3_1_7 ?? 'n.a.';
        $local_language_knowledge = $target_country_info->Testo2_3_1_9 ?? 'n.a.';
        $local_language_knowledge_level = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '1_10')  ?? 'n.a.'; // valori da 1 a 5 dove dove 1 è “molto basica” e 5 è “fluente”

        /*your goal*/
        $goals = [
            '1' => 'Ho terminato/sto terminando gli studi e sto cercando la mia prima esperienza professionale',
            '2' => 'Vorrei fare un’esperienza di crescita all’estero',
            '3' => 'Sono insoddisfatto del mio attuale ruolo e vorrei aprirmi a nuove esperienze professionali',
            '4' => 'Soffro per la mancanza di opportunità nel mio paese',
            '5' => 'Altro',
        ];
        $your_goal_code = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_4') ?? null;
        if($your_goal_code) {
            if($your_goal_code == '5' ) {
                $your_goal = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_4_altro') ?? 'n.a.'; 
            } else {
                $your_goal = $goals[$your_goal_code];
            }
        } else {
            $your_goal = 'n.a.';
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
        $your_motivation_code = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_6') ?? null;
        if($your_motivation_code) {
            if($your_motivation_code == '6' ) {
                $your_motivation = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_6_altro') ?? 'n.a.';
            } else {
                $your_motivation = $motivations[$your_motivation_code];
            }
        } else {
            $your_motivation = 'n.a.';
        }
        /*your target role*/
        $target_role = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_8') ?? 'n.a.';
        /*sectors you can aim at*/
        $target_sector = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_10') ?? 'n.a.';
        /*In [paese] è [facile/difficile] spostarsi da un settore all'altro*/
        $modality = $target_country_info->modalita ?? null;
        /*cultural fit*/
        $cultural_fit = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_13') ?? 'n.a.';
        /*gap/ostacoli*/
        $gaps = $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '2_15') ?? 'n.a.';

        /*cv check*/
        $cv_check = [
            'europass' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_2') ?? null,
            'language' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_4') ?? null,
            'lenght' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_6') ?? null,
            'profile' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_8') ?? null,
            'contacts' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_10') ?? null,
            'informations' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_12') ?? null,
            'linkedin' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '3_14') ?? null,
        ];
        $cv_check_score = null;
        if(!in_array(null, $cv_check)) {
            $cv_check_sum = array_sum($cv_check);
            $cv_check_score = $cv_check_sum.' su '. count($cv_check);
        } 

        /*cover letter*/
        $cover_letter = [
            'lenght' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '4_6') ?? null,
            'language' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '4_8') ?? null,
            'motivation' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '4_10') ?? null,
            'adjectives' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '4_12') ?? null,
            'advantages' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '4_17') ?? null,
        ];
        $cover_letter_score = null;
        if(!in_array(null, $cover_letter)){
            $cover_letter_sum = array_sum($cover_letter);
            $cover_letter_score = $cover_letter_sum.' su '. count($cover_letter);
        }





        /*lettera di presentazione*/
        /// no info a db


        /*job-hunt report2*/
        $useful_sites_head_hunter = $target_country_info->Testo2_3_7_20 ?? 'n.a.';
        $useful_sites_job_board = $target_country_info->Testo2_3_7_20 ?? 'n.a.';
        $useful_sites_networking = $target_country_info->Testo2_3_7_20 ?? 'n.a.';

        $scores = VicB2CScore::where('IdUser', Auth::user()->id)->get();
        $score = 'n.a.';
        $head_hunter_score = $scores->where('report6_iscompleted', 1)->first()->report6_sum ?? null; // nel DB e-where: è la view vVic_b2c_punti_6_7_8 colonne: report6 
        $job_board_score = $scores->where('report7_iscompleted', 1)->first()->report7_sum ?? null; // nel DB e-where: è la view vVic_b2c_punti_6_7_8 colonna: report7
        $network_score = $scores->where('report8_iscompleted', 1)->first()->report8_sum ?? null; // nel DB e-where: è la view vVic_b2c_punti_6_7_8 colonna: report8
        if($head_hunter_score && $job_board_score && $network_score) {
            $points = $head_hunter_score + $job_board_score + $network_score;
            $total_base_score = count($scores);
            $score = $points.' su '.$total_base_score;
        } 
        /*STAR method items*/
        $star = [
            's' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '9_4') ?? 'n.a.',
            't' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '9_6') ?? 'n.a.',
            'a' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '9_8') ?? 'n.a.',
            'r' => $this->getResponseFromVicB2CChat($vic_b2c_current_user_chat, '9_10') ?? 'n.a.',
        ];

        $final_recommendations = $target_country_info->Testo2_3_11_5 ?? '-';

        return compact('target_country_name', 'main_product_sectors', 'your_selection_on_product_sectors', 'geographic_area_where_you_move', 'local_language_knowledge', 'local_language_knowledge_level', 'your_goal', 'your_motivation', 'target_role', 'target_sector', 'modality', 'cultural_fit', 'gaps', 'cv_check', 'cv_check_score', 'cover_letter', 'cover_letter_score', 'useful_sites_head_hunter', 'useful_sites_job_board', 'useful_sites_networking', 'score', 'final_recommendations', 'star');
    }


    public function generatePreparationReport() {

        $data = $this->fetchReportsData();
        if(!$data) {
            return  back()->with('error', 'You haven\'t compiled Vic yet');
        }

        $data['full_name'] = Auth::user()->name.' '.Auth::user()->surname;
        $data['name'] = Auth::user()->name;
        $data['origin_country'] = UserProfile::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first()->country ?? 'n.a.';
        $data['title'] = 'WELCOME IN WEXPLORE<br/>SBLOCCA IL POTENZIALE DELLA TUA CARRIERA';
        $data['meta_title'] = 'Vic Preparation Report';

        //dd($data);

        $pdf = PDF::loadView('reports.vic-b2c-preparation', $data);
        // return view('reports.vic-b2c-preparation', $data);
        // return $pdf->stream(); // load pdf in browser

        return $pdf->download('vic-b2c-preparation-report-'.Str::slug($data['full_name'], '-').'-'.date('Y-m-d').'-'.time().'.pdf');

    }


    public function generateJobHuntReport() {

        $data = $this->fetchReportsData();
        if(!$data) {
            return  back()->with('error', 'You haven\'t compiled Vic yet');
        }

        $data['full_name'] = Auth::user()->name.' '.Auth::user()->surname;
        $data['name'] = Auth::user()->name;
        $data['origin_country'] = UserProfile::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first()->country ?? 'n.a.';
        $data['title'] = 'WELCOME IN WEXPLORE<br/>SBLOCCA IL POTENZIALE DELLA TUA CARRIERA';
        $data['meta_title'] = 'Vic Job Hunt Report';

        $pdf = PDF::loadView('reports.vic-b2c-job-hunt', $data);
        // return view('reports.vic-b2c-job-hunt', $data);
        // return $pdf->stream(); // load pdf in browser

        return $pdf->download('vic-b2c-job-hunt-report-'.Str::slug($data['full_name'], '-').'-'.date('Y-m-d').'-'.time().'.pdf');

    }


    


    public function generateTakeOffReport() {
        return 'work in progress';
    }





    public function reportDocumentDownload($document_name) {
        if(file_exists(storage_path('app/documents/reports/vic/'.$document_name.'.docx'))) {

            if(!$this->paymentCheck($this->service_id)) {
                return abort(403, 'You have no order for this service!');
            }

            return Storage::download('documents/reports/vic/'.$document_name.'.docx');
        }

        return abort(404, 'Document Not Found');
    }






}
