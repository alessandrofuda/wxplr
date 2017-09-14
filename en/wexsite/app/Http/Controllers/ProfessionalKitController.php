<?php

namespace App\Http\Controllers;
use App\ConsultantServices;
use App\GlobalToolQuery;
use App\GoToMeeting;
use App\Order;
use Auth;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Country;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Setting;
use App\CultureMatchSurvey;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use ZipArchive;
use App\MarketAnalysis;
use App\AgePdf;
use App\GenderPdf;
use App\ConsultantProfile;
use App\EducationPdf;
use App\OccupationPdf;
use App\IndustryPdf;
use App\ConsultantAvailablity;
use App\ConsultantBooking;
use App\User;
use App\DreamCheckLab;
use App\SteadyAimShoot;
use App\CountryPdf;
use Validator;
use App\UserConsultantDiscussion;



class ProfessionalKitController extends CustomBaseController {

	public function __construct() {
		parent::__construct();
		//$this->middleware('redirectToUserProfile', ['except' => 'getLogout']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$cc_code=Country::all();
		$data['countries_code'] = $cc_code;
		$data['page_title']='Professional kit Profile';
		return view('client.user_profile_form', $data);
		//return view('front.professional_kit',$data);
	}

	public function overview() {
		$order = Order::where('user_id',\Auth::user()->id)->where('item_name','Professional Kit')->first();

		if($order != null) {

			if($order->step_id < 0) {
				return redirect("user/professional_kit/profile");
			}

		}
		$data['page_title'] = 'Professional Kit';
		return view('client.professional_kit_step', $data);
	}
	public function culture_match_iframe($country) {
		return view('front.culture_match_form',compact('country'));
	}

	public function culture_match_submit(Request $request) {
		$country = $request->get('country');
		return view('front.culture_match_iframe',compact('country'));
	}

	public function culture_match_index() {
		$cc_code=Country::all();
		$user_id = Auth::user()->id;
		$survey_code = CultureMatchSurvey::where('user_id',$user_id)->first(['survey_code']);
		$data['countries_code'] = $cc_code;
		$data['page_title']='Culture Match';
		$data['survey_code'] =  $survey_code;
		$order = Order::where('user_id',$user_id)->where('item_name','Professional Kit')->first();

		if($order != null) {

			if($order->step_id < 2) {
				$order->update([
					'step_id' => 2
				]);
			}

		}
		return view('front.culture_match',$data);
	}

	public function dream_check_lab(){
		$dream_check_lab_status = 0;
		$dream_check_lab =[];
		$user = \Auth::user();
		$dream_check_lab = DreamCheckLab::where('user_id',$user->id)->get();
		$step = 0;
		$active = 1;
		$order = Order::where('user_id',$user->id)->where('item_name','Professional Kit')->first();

		if($order != null) {

			if($order->step_id < 2) {
				$order->update([
					'step_id' => 2
				]);
			}

		}

		if($dream_check_lab->count() > 0){
			$step = $dream_check_lab->first()->state_id;
            $active = substr($step, -1);

            if(session('request_state') != null) {
                $active = session('request_state');
            }

			if($step == DreamCheckLab::STATE_COMPLETED)  {
				$dream_check_lab_status = 1;
			}

			$dream_check_lab = $dream_check_lab->first()->toArray();
			$data['dream_check_lab'] = $dream_check_lab;
		}else{
			$dream = new DreamCheckLab();
			$data['dream_check_lab'] = $dream;
		}

		$country=Country::all()->toArray();
		$data['country'] = $country;
		$data['dream_check_lab_status'] = $dream_check_lab_status;
		$data['page_title']='Dream Check Lab';
		$data['step'] = $step;
		$data['active'] = $active;

		return view('client.dream_check_lab',$data);
	}

	public function dream_check_lab_store(Request $request){
		//echo '<pre>'; print_r($request->all()); die;
		// create achievement three forms validation rule by foreach
		//dd($request->file('upload_cv')->getMimeType()); die;
		$request_state = $request->get('state_id');
        session(['request_state' => $request_state]);
		if($request_state == 1) {
			$rules['upload_cv'] = 'required|mimes:doc,docx,odt';
			$rules['state_id'] = 'required';
		}elseif($request_state == 2) {
			$request_achievements = $request->get('achievement');
			foreach ($request_achievements as $key => $val) {
				foreach ($val as $k => $res) {
					$rules['achievement.' . $key . '.' . $k] = 'required';
				}
			}
		}elseif($request_state == 3) {
			// create validation rule of other fields
			$rules['your_objective'] = 'required';
			$rules['motivation'] = 'required';
			$rules['role_position'] = 'required';
			$rules['industry'] = 'required';
			$rules['company_characteristics'] = 'required';
			$rules['skills_support_objective'] = 'required';
			$rules['weakness_area'] = 'required';
			$rules['achievable_objective'] = 'required';
			$rules['fill_gap'] = 'required';
		}else{
			$rules['promotion_usp'] = 'required';
		}

		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}
        \Session::forget('request_state');
		if($request_state == 2) {
			foreach ($request_achievements as $ach_key => $achievement) {
				$dream_check_lab_data['achievement_role_organization' . $ach_key] = $achievement['role_organization'];
				$dream_check_lab_data['achievement_problem' . $ach_key] = $achievement['problem'];
				$dream_check_lab_data['achievement_action' . $ach_key] = $achievement['action'];
				$dream_check_lab_data['achievement_result' . $ach_key] = $achievement['result'];
				$dream_check_lab_data['achievement_skills' . $ach_key] = $achievement['skills'];
			}
		}
		elseif($request_state == 3) {
				$dream_check_lab_data['your_objective'] = $request->get('your_objective');
				$dream_check_lab_data['motivation'] = $request->get('motivation');
				$dream_check_lab_data['role_position'] = $request->get('role_position');
				$dream_check_lab_data['industry'] = $request->get('industry');
				$dream_check_lab_data['company_characteristics'] = $request->get('company_characteristics');
				$dream_check_lab_data['skills_support_objective'] = $request->get('skills_support_objective');
				$dream_check_lab_data['weakness_area'] = $request->get('weakness_area');
				$dream_check_lab_data['achievable_objective'] = $request->get('achievable_objective');
				$dream_check_lab_data['fill_gap'] = $request->get('fill_gap');
		}else{
				$dream_check_lab_data['promotion_usp'] = $request->get('promotion_usp');
		}

		if($request_state == 1) {
			$cv_file = $request->file('upload_cv');

			$base_path = base_path();
			$base_path = str_replace("/wexsite", "", $base_path);
			$file_save_folder_path = '/uploads/cv_file/';
			// get cv file
			if (!empty($cv_file)) {
				$cv_original_name = $cv_file->getClientOriginalName();
				if (file_exists($base_path . $file_save_folder_path . $cv_original_name)) {
					$cv_file_name = time() . '-' . $cv_original_name;
					//$outcome_image->getClientOriginalExtension();
				} else {
					$cv_file_name = $cv_original_name;
				}
				$cv_file_name = str_replace(' ', '-', $cv_file_name);
				$cv_file_path = $file_save_folder_path . $cv_file_name;
				$cv_public_path = $base_path . $file_save_folder_path;
				$cv_file->move($cv_public_path, $cv_file_name);
				$dream_check_lab_data['cv_file'] = $cv_file_path;
			}
		}
		$user = Auth::user();
		$dream_check_lab_data['user_id'] = $user->id;
		$dream_check_lab_data['state_id'] = $request['state_id'];
		//Save values in database
		$dreamcheck_lab_obj = DreamCheckLab::where('user_id',$user->id)->first();

		if($dreamcheck_lab_obj != null) {
			$state = $dreamcheck_lab_obj->state_id;
            if(strstr($state,$request->get('state_id'))) {
                $state = str_replace($request->get('state_id'),'',$state);
            }
			$newstate = $state.$request['state_id'];
			$dream_check_lab_data['state_id'] = $newstate;
			$dreamcheck_lab_obj->update($dream_check_lab_data);
		}else {
			$dreamcheck_lab_obj = DreamCheckLab::create($dream_check_lab_data);
		}


		$data['dream_check_lab_id'] = $dreamcheck_lab_obj->id;
        $dream_check_lab_status = 0;
        $dream_check_lab =[];
        $user = \Auth::user();
        $dream_check_lab = DreamCheckLab::where('user_id',$user->id)->get();
        $step = 0;
        $active = 1;
      /*  $order = Order::where('user_id',$user->id)->where('item_name','Professional Kit')->first();

        if($order != null) {
            if($order->step_id < 4) {
                $order->update([
                    'step_id' => 4
                ]);
            }
        }*/

        if($dream_check_lab->count() > 0){
            $step = $dream_check_lab->first()->state_id;
            $active = substr($step, -1);
            if($step == DreamCheckLab::STATE_COMPLETED)  {
                $dream_check_lab_status = 1;
            }
            $dream_check_lab = $dream_check_lab->first()->toArray();
            $data_view['dream_check_lab'] = $dream_check_lab;
        }
        $country=Country::all()->toArray();
        $data_view['country'] = $country;
        $data_view['dream_check_lab_status'] = $dream_check_lab_status;
        $data_view['page_title']='Dream Check Lab';
        $data_view['step'] = $step;
        $data_view['active'] = $active;
        $view = view('client.dream_check_lab',$data_view);
		$data['html'] = $view->render();
		return $data;
	}

	public function dream_check_lab_submit(Request $request) {
		$rules['interest_country'] = 'required';
		//$rules['form_id'] = 'required';
		$validator = Validator::make($request->all(),$rules);
        $data = ['status' => 'NOK'];
        session(['request_state' => '4']);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}
        \Session::forget('request_state');
        if($request->get('form_id') != null) {
            $dreamcheck_lab_obj = DreamCheckLab::where('id', $request->get('form_id'))->first();
            $interested_country = $request->get('interest_country');
            $user = Auth::user();
            if ($dreamcheck_lab_obj != null) {
                if (strstr($dreamcheck_lab_obj->state_id, "1")
                    && strstr($dreamcheck_lab_obj->state_id, "2")
                    && strstr($dreamcheck_lab_obj->state_id, "3")
                    && strstr($dreamcheck_lab_obj->state_id, "4")
                ) {
                    $dreamcheck_lab_obj->update(['state_id' => DreamCheckLab::STATE_COMPLETED,
					'interest_country' => $interested_country]);

                    $consultant_profiles = ConsultantProfile::where('country_expertise', $interested_country)
                        ->orderBy('email_count')->get();
                    $data['dream_check_lab_id'] = $dreamcheck_lab_obj->id;
					$order = \App\Order::where('user_id',$dreamcheck_lab_obj->user_id)->where('item_name','Professional Kit')->first();
					$order->update([
						'step_id' => 3
					]);

					$ok = false;

                    if (count($consultant_profiles) > 0) {
						foreach ($consultant_profiles as $consultant_profile) {
							$service = ConsultantServices::where('user_id', $consultant_profile->user_id)
								->where('service_id', ConsultantServices::SERVICE_PROFESSIONAL_KIT)
								->where('state_id', ConsultantServices::STATE_ACTIVE)->first();

							if ($service != null) {
								$ok = true;
								$user_obj = $consultant_profile->user;
								$to_email = $user_obj->email;
								$consultant_profile->increment('email_count');
								Mail::send('emails.dream_check_consultant_notification', ['data' => $data],
									function ($m) use ($to_email) {
										$settings = Setting::find(1);
										$site_email = $settings->website_email;
										$m->from($site_email, 'Wexplore');
										$m->to($to_email, 'Wexplore')->subject('Dream Check Lab Submission!');
									});
								$dreamcheck_lab_obj->update(['validate_by' => $consultant_profile->user_id]);
								break;
							}
						}
                    }

					if($ok == false) {
                        /* Email to admin */
                        $user_id = $user->id;
                        $user_fname = $user->name;
                        $user_surname = $user->surname;
                        $user_name = $user_fname . ' ' . $user_surname;
                        $user_array = ['user_name' => $user_name, 'user_id' => $user_id];
                        //echo  '<pre>'; print_r($user_array); echo '</pre>'; die;
                        Mail::send('emails.dream_check_admin_notification', ['user_array' => $user_array, 'data' => $data], function ($m) {
                            $settings = Setting::find(1);
                            $site_email = $settings->website_email;
                            $m->from($site_email, 'Wexplore');
                            $m->to($site_email, 'Wexplore')->subject('Dream Check Lab submission but no matching consultant Found!');
                        });
                    }

					$base_path = base_path();
					$base_path = str_replace("/wexsite", "", $base_path);
					$pdf_path = '/uploads/dream_form_'.time().'.pdf';

					$viewdata['dream_check_lab'] = $dreamcheck_lab_obj;
					$viewdata['page_title'] = 'Dream Check Lab Form';
					$pdf = \App::make('dompdf.wrapper');
					$pdf->loadView('client.dream_check_lab_pdf', $viewdata);
					$pdf->save($base_path.$pdf_path);

					$dreamcheck_lab_obj->update([
						'form_pdf' => $pdf_path
					]);


                    $data['status'] = 'OK';
                    $data['url'] = route('dream.check.lab');
                  //  session(['status' => 'Thank you for your confirmation! You are now being matched to your consultant. He or she will review the forms you have submitted within the next 3 working days.']);
                }
            }
        }
		return $data;
	}

	public function download_form($id) {
		$dream_check_lab = DreamCheckLab::where('id',$id)->first();
		if($dream_check_lab != null) {
			$data['dream_check_lab'] = $dream_check_lab;
            $data['page_title'] = 'Dream Check Lab Form';
            $data['popol'] = 'poipol';
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('client.dream_check_lab_pdf', $data);
            return $pdf->stream();
			/*$pdf = \PDF::loadView('client.dream_check_lab_pdf', $data);
			return $pdf->download('invoice.pdf');*/
		}
		return redirect()->back()->with('status','Could not found your form');
	}

	public function dream_check_lab_submission_feedback($dreamcheck_id){
		$dream_check_lab =[];
		$dream_check_lab_feedback = [];
		$dream_check_lab_obj = DreamCheckLab::where('id',$dreamcheck_id)
			->where('validate',1)
			->first();
		if(!empty($dream_check_lab_obj)){
			$dream_check_lab = $dream_check_lab_obj->toArray();
			$feedback_obj = $dream_check_lab_obj->feedback()->first();
			if(!empty($feedback_obj)) {
				$dream_check_lab_feedback = $feedback_obj->toArray();
			}
			//echo  '<pre>'; print_r($feedback_obj); echo '</pre>'; die;
		}
		//echo  '<pre>'; print_r($dream_check_lab); echo '</pre>'; die;
		$data['dream_check_lab_feedback'] = $dream_check_lab_feedback;
		$data['page_title']='Dream Check Lab Submission Feedback';
		return view('client.dream_check_lab_submission_feedback',$data);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
	public function returnLabourFiles(){
		$related_pdfs=[];
		$user = Auth::user();
		$user_profile = $user->userProfile;
		$age_range = $user_profile->age_range;
		$gender = $user_profile->gender;
		$education = $user_profile->education;
		$education = strtolower(str_replace(' ','_',$education));
		$occupation = $user_profile->occupation;
		$occupation = strtolower(str_replace(' ','_',$occupation));
		$industry = $user_profile->industry;
		$industry = strtolower(str_replace(' ','_',$industry));
		// Get age pdfs
		$age_obj = AgePdf::where('age_range',$age_range)->first(['age_pdf','age_pdf_name']);
		if(!empty($age_obj)){
			$related_pdfs[] = ['pdf_path'=>$age_obj->age_pdf,'pdf_name'=>$age_obj->age_pdf_name,'type'=>'age'];
		}
		// Get Gender Pdfs
		$gender_obj = GenderPdf::where('gender',$gender)->first(['gender_pdf','gender_pdf_name']);

		if(!empty($gender_obj)){
			$related_pdfs[] = ['pdf_path'=>$gender_obj->gender_pdf,'pdf_name'=>$gender_obj->gender_pdf_name,'type'=>'gender'];
		}
		// Get Education Pdfs
		$education_obj=EducationPdf::where('education',$education)->first(['education_pdf','education_pdf_name']);
		if(!empty($education_obj)){
			$related_pdfs[]=['pdf_path'=>$education_obj->education_pdf,'pdf_name'=>$education_obj->education_pdf_name,'type'=>'education'];
		}
		// Get Occupation Pdfs
		$occupation_obj=OccupationPdf::where('occupation',$occupation)->first(['occupation_pdf','occupation_pdf_name']);
		if(!empty($occupation_obj)){
			$related_pdfs[]=['pdf_path'=>$occupation_obj->occupation_pdf,'pdf_name'=>$occupation_obj->occupation_pdf_name,'type'=>'occupation'];
		}
		// Get Industry Pdfs
		$industry_obj=IndustryPdf::where('industry',$industry)->first(['industry_pdf','industry_pdf_name']);
		if(!empty($industry_obj)){
			$related_pdfs[]=['pdf_path'=>$industry_obj->industry_pdf,'pdf_name'=>$industry_obj->industry_pdf_name,'type'=>'industry'];
		}

		return $related_pdfs;
	}

	public function returnMarketAnalysisData(){
		$mk_obj=MarketAnalysis::all();
		foreach($mk_obj as $mks){
			$market_analysis_data[$mks->market_analysis_type]['market_analysis_desc']=$mks->market_analysis_desc;
			$mk_pdfs=$mks->MarketAnalysisPdf;
			foreach($mk_pdfs as $mk_pdf){
				$market_analysis_data[$mks->market_analysis_type]['pdfs'][]=array('pdf_path'=>$mk_pdf->market_analysis_pdf,'pdf_name'=>$mk_pdf->market_analysis_pdf_label);
			}
		}
		return $market_analysis_data;
	}

	public function market_analysis(){
		$related_pdfs = $this->returnLabourFiles();
		$market_analysis_data = $this->returnMarketAnalysisData();

		$data['market_analysis_data']=$market_analysis_data;
		$data['related_pdfs']=$related_pdfs;
		$data['page_title']='Market Analysis';

		$order = Order::where('user_id',\Auth::user()->id)->where('item_name','Professional Kit')->first();

		if($order != null) {

			if($order->step_id < 1) {
				$order->update([
					'step_id' => 1
				]);
			}

		}

		return view('front.market_analysis',$data);
	}
	public function zipFilesAndDownload($file_names,$archive_file_name,$overwrite = false)
	{
		$zip = new ZipArchive();
		if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
			exit("cannot open <$archive_file_name>\n");
		}
		foreach($file_names as $files){
			$zip->addFile($files['local'],$files['file_name']);
		}
		$zip->close();
		header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename=$archive_file_name");
		header('Content-Length: ' . filesize($archive_file_name));
		header("Pragma: no-cache");
		header("Expires: 0");
		ob_clean();
		flush();
		readfile($archive_file_name);
		unlink($archive_file_name);
	}
	public function labourDownload(){
		$related_pdfs = $this->returnLabourFiles();
		/* zip download file for labour pdfs */
		$labour_pdfs = array();
		foreach($related_pdfs as $i=>$rp){
			$file_names=explode('/',$rp['pdf_path']);
			$labour_pdfs[]=['local' => $_SERVER['DOCUMENT_ROOT'].'/wexplore/'. $rp['pdf_path'],'file_name'=>last($file_names)];
		}
		$archive_file_name = 'labour_files.zip';
		/* end */
		$this->zipFilesAndDownload($labour_pdfs,$archive_file_name);
	}
	public function qualityWorkDownload(){
		$market_analysis_data = $this->returnMarketAnalysisData();

		$quality_work_pdfs = $market_analysis_data['quality_of_work']['pdfs'];
		/* zip download file for Quality WOrk pdfs */
		$quality_works = array();
		foreach($quality_work_pdfs as $i=>$rp){
			$file_names=explode('/',$rp['pdf_path']);
			$quality_works[]=['local' => $_SERVER['DOCUMENT_ROOT'].'/wexplore/'. $rp['pdf_path'],'file_name'=>last($file_names)];
		}
		//print_r($quality_works);exit;
		$archive_file_name = 'quality_works_files.zip';
		/* end */
		$this->zipFilesAndDownload($quality_works,$archive_file_name);
	}
	public function qualityLifeDownload(){
		$market_analysis_data = $this->returnMarketAnalysisData();

		$quality_life_pdfs = $market_analysis_data['quality_of_life']['pdfs'];
		/* zip download file for Quality life pdfs */
		$quality_life = array();
		foreach($quality_life_pdfs as $i=>$rp){
			$file_names=explode('/',$rp['pdf_path']);
			$quality_life[]=['local' => $_SERVER['DOCUMENT_ROOT'].'/wexplore/'. $rp['pdf_path'],'file_name'=>last($file_names)];
		}
		//print_r($quality_works);exit;
		$archive_file_name = 'quality_life_files.zip';
		/* end */
		$this->zipFilesAndDownload($quality_life,$archive_file_name);
	}
	public function role_play_interview() {
		$consultant_avail = '';
		$consultant = '';
		$user = Auth::user();
		$dreamcheck_lab = DreamCheckLab::where('user_id',$user->id)->first(['validate_by'])->toArray();
		$consultant = User::find($dreamcheck_lab['validate_by']);		// consultant che ha fatto la validazione della richiesta dell'utente
		$order = Order::where('user_id',$user->id)->where('item_name','Professional Kit')->first();

		$booking = ConsultantBooking::where('user_id', \Auth::user()->id)
									->where('type_id', ConsultantBooking::TYPE_INTERVIEW)   // constant = 0
									->where('status','!=',ConsultantBooking::STATE_CANCELLED)  // constant = 2
									->first();
		// dd($booking);
		$consultant_avail = [];


		if($booking == null) {

			if ($order != null) {
				if ($order->step_id < 3) {
					$order->update([
						'step_id' => 3
					]);
				}
			}

			if (!empty($consultant)) {
				$consultant_id = $consultant->id;
				$booked_data = ConsultantBooking::where('status', '!=', ConsultantBooking::STATE_CANCELLED)->get();  // STATE_CANCELLED = 2

				$today_date = date('Y-m-d', strtotime('today'));
				$today = Setting::dateUtc($today_date);
				if (isset($booked_data) && $booked_data->count() > 0) {
					$booked_ids = [];

					foreach ($booked_data as $bdata) {
						$booked_ids[] = $bdata->availablity_id;
					}
					//print_r(strtotime($today));exit;
					$consultant_avail = ConsultantAvailablity::where('consultant_id', $consultant_id)
						->where('available_date', '>', strtotime($today))
						->where('type_id', ConsultantAvailablity::AREA_CAREER_SESSION)
						->whereNotIn('id', $booked_ids)
						->get();
				} else {
					$consultant_avail = ConsultantAvailablity::where('consultant_id', $consultant_id)
						->where('available_date', '>', strtotime($today))
						->where('type_id', ConsultantAvailablity::AREA_CAREER_SESSION)->get();
				}
			}
		}else{
			$data['already_booked'] = 'You have already booked your appointment with the consultant.';
		}
		//$data['dreamcheck_lab'] = $dreamcheck_lab;
		// get booking

		$data['consultant'] = $consultant;
		$data['consultant_avail'] = $consultant_avail;
		$data['page_title']='Career Orientation Session';


		// discussion
		$discuss_id = $user->id.$consultant->id; 
		$data['discuss_id'] = $discuss_id;
		
		$discussions = UserConsultantDiscussion::whereIn('user_id', [$user->id, $consultant->id])
											   ->where('discuss_id', $discuss_id)
											   ->get();
		
		$data['discussions'] = $discussions;

		return view('client.role_play_interview',$data);

	}


	public function consultant_list(){
		$data['page_title']='Matching Consultant Listing';
		$country_interest = Auth::user()->userProfile->country_interest;
		$consultant_data = ConsultantProfile::where('country_expertise',$country_interest)->get();
		$data['consultant_list'] = $consultant_data;
		//echo '======<pre>';print_r($consultant_data);exit;
		return view('client.user_consultant_list',$data);
	}

	public function consultant_booked_list(){
		$user_id = Auth::user()->id;
		$data['page_title']='Booked Consultant Listing';
		$booked_consultants = ConsultantBooking::where('user_id',$user_id)->get();
		$data['booked_consultants'] = $booked_consultants;
		return view('client.user_consultant_booked_list',$data);
	}
	public function consultant_cancel_booking(Request $request){
		$user = Auth::user();
		$booking_id = $request['booking_id'];
		$ConsultantBooking = ConsultantBooking::find($booking_id);
		$ConsultantBooking->update(['status'=>0]);
		//print_r($ConsultantBooking);exit;
		/* Email to user */
		Mail::send('emails.consultant_booking_cancel', ['user'=>$user,'consultantbooking'=>$ConsultantBooking], function ($m) use ($user) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$to = $user->email;
			$name = $user->name;
			$m->from($site_email, 'Wexplore');
			$m->to($to, $name)->subject('Consultant Booking Cancelled!');
		});
		/* Email to consultant */
		Mail::send('emails.user_booked_consultant_cancel', ['consultantbooking'=>$ConsultantBooking], function ($m) use ($ConsultantBooking) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$to = $ConsultantBooking->availablity->consultant->email;
			$name = $ConsultantBooking->availablity->consultant->name;
			$m->from($site_email, 'Wexplore');
			$m->to($to, $name)->subject('Consultant Booking Cancelled!');
		});
		/* Email to super admin */
		Mail::send('emails.admin_consultant_booking_cancel', ['consultantbooking'=>$ConsultantBooking], function ($m) use ($ConsultantBooking) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$m->from($site_email, 'Wexplore');
			$m->to($site_email, 'Wexplore')->subject('Consultant Booking Cancelled!');
		});
		/* email end */
		return redirect('user/consultant/booked/list')->with('status', 'Booking has been canceled!');
	}

	public function availability_calender($id, $type = ConsultantBooking::TYPE_INTERVIEW){
		$booked_ids = array();
		$data['page_title']='Consultant Availability Calender';
		$c_id = '';
		$a_type = '';
		if($type = ConsultantBooking::TYPE_QUERY) {
			$query = GlobalToolQuery::find($id);
			$c_id = $query->consultant_id;
			$a_type = $query->question_type_id;
		}elseif($type = ConsultantBooking::TYPE_INTERVIEW) {
			$query = DreamCheckLab::find($id);
			$c_id = $query->validate_by;
			$a_type = ConsultantAvailablity::AREA_INTERVIEW;
		}

		$booked_data = ConsultantBooking::where('status','!=',2)->get(['availablity_id']);

		if(isset($booked_data) && !empty($booked_data)){
			foreach($booked_data as $bdata){
				$booked_ids[] = $bdata['availablity_id'];
			}
			$consultant_avail = ConsultantAvailablity::where('consultant_id',$c_id)->whereNotIn('id', $booked_ids)->get();
		}else{
			$consultant_avail = ConsultantAvailablity::where('consultant_id',$c_id)->get();
		}
		//echo '<pre>';print_r($consultant_avail);exit;
		$data['consultant_avail'] = $consultant_avail;
		return view('client.consultant_availability_calender',$data);
	}


	public function rebooking_calender($id){
		$booked_ids = array();
		$data['page_title']='Consultant Availability Calender';
		$booked_data = ConsultantBooking::where('status','!=',0)->get(['availablity_id']);
		if(isset($booked_data) && !empty($booked_data)){
			foreach($booked_data as $bdata){
				$booked_ids[] = $bdata['availablity_id'];
			}
			$consultant_avail = ConsultantAvailablity::where('consultant_id',$id)->whereNotIn('id', $booked_ids)->get();
		}else{
			$consultant_avail = ConsultantAvailablity::where('consultant_id',$id)->get();
		}
		//echo '<pre>';print_r($consultant_avail);exit;
		$data['consultant_avail'] = $consultant_avail;
		return view('client.consultant_availability_calender',$data);
	}
	public function consultant_book(Request $request){
		$user = Auth::user();
		$user_id = $user->id;
		$availablity_id = $request['availablity_id'];
		$availablity = ConsultantAvailablity::find($availablity_id);

		$check_if_already_book = ConsultantBooking::where(['availablity_id'=>$availablity_id,'user_id'=>$user_id])
			->get();
		$dreamchecklab = DreamCheckLab::where('user_id', Auth::user()->id)->first();

		if(isset($check_if_already_book) && $check_if_already_book->count() > 0){
			$ConsultantBooking_obj = ConsultantBooking::where(['availablity_id'=>$availablity_id,'user_id'=>$user_id])
				->update(['status'=>ConsultantBooking::STATE_PENDING]);
			$ConsultantBooking = ConsultantBooking::where(['availablity_id'=>$availablity_id,'user_id'=>$user_id])->first();
		}else{
			$ConsultantBooking = ConsultantBooking::create(['user_id'=>$user_id,'availablity_id'=>$availablity_id,
			'type_id' => ConsultantBooking::TYPE_INTERVIEW, 'query_id' => $dreamchecklab->id,
			'state_id' => ConsultantBooking::STATE_PENDING]);
		}



		//Save meeting on gotomeeting server
		$meeting = GoToMeeting::where('booking_id', $ConsultantBooking->id)->first();

		if($meeting == null)
			$data = $ConsultantBooking->saveMeeting(GoToMeeting::TYPE_MEETING);

		/* Email to user */
		Mail::send('emails.consultant_booking', ['user'=>$user,'consultantbooking'=>$ConsultantBooking], function ($m) use ($user) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$m->from($site_email, 'Wexplore');
			$m->to($user->email, $user->name)->subject('Consultant Booking!');
		});

		/* Email to consultant */
		Mail::send('emails.user_booked_consultant', ['consultantbooking'=>$ConsultantBooking], function ($m) use ($ConsultantBooking) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$to = $ConsultantBooking->availablity->consultant->email;
			$name = $ConsultantBooking->availablity->consultant->name;
			$m->from($site_email, 'Wexplore');
			$m->to($to, $name)->subject('New Consultant Booking!');
		});

		/* Email to super admin */
		Mail::send('emails.admin_consultant_booking', ['consultantbooking'=>$ConsultantBooking], function ($m) use ($ConsultantBooking) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$m->from($site_email, 'Wexplore');
			$m->to($site_email, 'Wexplore')->subject('New Consultant Booking!');
		});

		$availablity ->update(
			['is_booked' => ConsultantAvailablity::STATUS_BOOKED]
		);

		/* email end */
		return redirect()->back()->with('status','Thank you! Your session is now booked! Please check appointments. Do not forget to log back in your dashboard to connect with your consultant!');
	}

	public function start_meeting($id) {
		$data['page_title'] = 'Session';
		$appointment = ConsultantBooking::find($id);

		if(!$appointment->checkDate()) {
			return redirect('user/dashboard')->with('error', 'Meeting is expired.');
		}

		$data['appointment'] = $appointment;
		$data['noti_mesg'] = '';
		return view('client.session',$data);
	}

	/* create steady aim shoot page */
	public function steady_aim_shoot(){
		$steady_aim_shoot_arr  = [];
		$steady_aim_shoot_obj  = SteadyAimShoot::find(1);
		if(is_object($steady_aim_shoot_obj) && !empty($steady_aim_shoot_obj))
		{
			//echo '<pre>'; print_r( $steady_aim_shoot_obj->toArray()); exit;
			$id       					= $steady_aim_shoot_obj['id'];
			$top_description       		= $steady_aim_shoot_obj['top_description'];
			$bottom_description    		= $steady_aim_shoot_obj['bottom_description'];
			$whats_now     				= $steady_aim_shoot_obj['whats_now'];
			$steady_aim_shoot_pdf 		= $steady_aim_shoot_obj['steady_aim_shoot_pdf'];
			$steady_aim_shoot_pdf_label = $steady_aim_shoot_obj['steady_aim_shoot_pdf_label'];

			$steady_aim_shoot_arr 		= [ 'id'     				=> $id,
											'top_description'  		=> $top_description,
											'bottom_description'	=> $bottom_description,
											'whats_now'   			=> $whats_now,
											'steady_aim_shoot_pdf'	=> $steady_aim_shoot_pdf,
											'steady_aim_shoot_pdf_label'=> $steady_aim_shoot_pdf_label
											];
		}
		$user_id = Auth::user()->id;
		$order = Order::where('user_id',$user_id)->where('item_name','Professional Kit')->first();

		if($order != null) {
			if($order->step_id < 5) {
				$order->update([
					'step_id' => 5
				]);
			}
		}
		$interest_country_pdf = '';
		$interest_country_arr = [];
		$interest_country_obj = DreamCheckLab::where('user_id',$user_id)->first(['interest_country']);

		if(is_object($interest_country_obj) && !empty($interest_country_obj))
		{
			$interest_country = $interest_country_obj['interest_country'];

			$country_pdf_obj = CountryPdf::where('country_name',$interest_country)->first();

			if(is_object($country_pdf_obj) && !empty($country_pdf_obj))
			{
				//echo '<pre>'; print_r( $country_pdf_obj->toArray()); exit;
				$interest_country_pdf 		= $country_pdf_obj['country_pdf'];
				$interest_country_pdf_label = $country_pdf_obj['country_pdf_label'];
				$interest_country_arr = ['interest_country_pdf' => $interest_country_pdf, 'interest_country_pdf_label' => $interest_country_pdf_label];
			}

		}

		//echo '<pre>'; print_r( $interest_country_arr); exit;
		$data['interest_country']  		= $interest_country_arr;
		$data['steady_aim_shoot']      	= $steady_aim_shoot_arr;
		$data['page_title'] = "STEADY, AIM, SHOOT";
		return view('client.steady_aim_shoot',$data);
	}
	public function role_play_video() {
		$data['page_title'] = "Live video chat";
		return view('front.role_play_video',$data);
	}



	public function post_user_discussion(Request $request)
	{

		// input validation
		$rules['user_id'] = 'required|integer';
		$rules['discuss_id'] = 'required|integer';
		$rules['message'] = 'required|string';
		
		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}


		//client
		$user = Auth::user();

		// consultant
		$consultant_id = DreamCheckLab::where('user_id',$user->id)->first(['validate_by'])->toArray();
		$consultant_id = $consultant_id['validate_by'];
		$consultant = User::find($consultant_id);

		// insert in db
		$discuss_id =  $user->id.$consultant->id; //$request['discuss_id'];
		$message = $request['message'];
		$new_message = UserConsultantDiscussion::create(['user_id'=> $user->id, 'discuss_id'=> $discuss_id, 'message'=> $message]);


		// send mail to Consultant
		$msg['from'] = $user->name;
		$msg['to'] = $consultant->name;
		$msg['message'] = $message;

		Mail::send('emails.post_user_discussion', ['msg' => $msg], function ($m) use ($consultant) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$to = $consultant->email;
			$name =  $consultant->name.' '. $consultant->surname;
			$m->from($site_email, 'Wexplore');
			$m->to($to, $name)->subject('New message from Wexplore\'s user!');
		});

		

		// redirect to same page with('message', '...')
		return redirect()->back()->with('status','Message sent to Consultant. Please wait for a feedback');
	}


	public function post_consultant_discussion(Request $request)
	{

		// input validation
		$rules['user_id'] = 'required|integer';
		$rules['discuss_id'] = 'required|integer';
		$rules['message'] = 'required|string';
		
		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}


		//consultant
		$consultant = Auth::user();

		// client
		$client_id = DreamCheckLab::where('validate_by',$consultant->id)->first(['user_id'])->user_id; 
		$client = User::find($client_id);

		// insert in db
		$discuss_id =  $client->id.$consultant->id; //$request['discuss_id'];
		$message = $request['message'];
		$new_message = UserConsultantDiscussion::create(['user_id'=> $consultant->id, 'discuss_id'=> $discuss_id, 'message'=> $message]);


		// send mail to Consultant
		$msg['from'] = $consultant->name;
		$msg['to'] = $client->name;
		$msg['message'] = $message;

		Mail::send('emails.post_consultant_discussion', ['msg' => $msg], function ($m) use ($client) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$to = $client->email;
			$name =  $client->name.' '. $client->surname;
			$m->from($site_email, 'Wexplore');
			$m->to($to, $name)->subject('New message from Wexplore\'s Consultant!');
		});

		

		// redirect to same page with('message', '...')
		return redirect()->back()->with('status','Message sent to Client. Please wait for a feedback and then proceed to booking meeting date 
filling the \'Consultant Availability Form\' below.');

	}



}


