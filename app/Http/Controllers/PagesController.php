<?php

namespace App\Http\Controllers;

use App\Blog;
use App\CultureMatchSurvey;
use App\MetaTags;
use App\Partners;
use App\Slider;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Page;
use App\GlobalTest;
use App\GlobalTestChoices;
use App\GlobalTestOutcomes;
use App\GlobalTestResult;
use App\Service;
use App\Order;
use Mail;
use Route;
use App\Setting;
use Validator;
use Carbon;
use App\DreamCheckLab;
use App\User;
use App\ConsultantBooking;

use Illuminate\Support\Facades\Log;

class PagesController extends CustomBaseController {

	const MAILCHIMP_LIST_GROUP_GLOBAL_ORIENTATION_TEST = '882a0e5cfb';
	const MAILCHIMP_LIST_GROUP_PROFESSIONAL_KIT = 'eb56a232f1';
	const MAILCHIMP_LIST_GROUP_SKILLS_DEVELOPMENT = '4cfd24aacd';
	const MAILCHIMP_LIST_GROUP_GLOBAL_TOOLBOX = '7d5c4ada11';
	const MAILCHIMP_LIST_GROUP_AIESEC = 'd8b559b138';

	public function homepage() {
		$services = Service::get();
		$services_arr = [];
		$purchase = array(
			'purchased' => 'no',
		);
		foreach($services as $service) {
			$url = '';

			if($service->name == 'Skill Development') {
				$url = url('skill_development/browse');
			}elseif($service->name == 'Global Orientation Test') {
				$url = url('/global_orientation_test');
			}elseif($service->name == 'Global Toolbox') {
				$url = url('/global_toolbox');
			}elseif($service->name == 'Professional Kit') {
				$url = url('/professional_kit');
			}

			$services_arr[$service->id] = array(
				'name'=>$service->name,
				'id'=>$service->id,
				'image'=>$service->image,
				'user_dashboard_image'=>$service->user_dashboard_image,
				'price'=>$service->price,
				'description'=>$service->description,
				'url' => $url,
				'purchased'=>'no',
				'user_dashboard_desc'=>$service->user_dashboard_desc
			);

			if(Auth::check()) {
				$user_id = Auth::user()->id;
				$user_service = Order::where('user_id', $user_id)->where('item_id', $service->id)->where('item_type', 'service')->first();
				if ($user_service != null) {
					$services_arr[$service->id]['purchased'] = 'yes';
				}else{
					$services_arr[$service->id]['purchased'] = 'no';
				}
			}
		}
		$data['services'] = $services_arr;
		$blogs = Blog::limit('3')->get();
		$data['blogs'] = $blogs;
		$sliders = Slider::all();
		$data['sliders'] = $sliders;
		$meta_tag = MetaTags::where('page_type', MetaTags::PAGE_TYPE_HOME)->first();
		$data['meta_tag'] = $meta_tag;
		
		return view('front.new_homepage',$data);
	}

	public function setTimezone(Request $request) {
		if($request->get('timezone')) {
			\Session::put('timezone',$request->get('timezone'));

			if(\Auth::check()) {
				\Auth::user()->update([
					'timezone' => $request->get('timezone')
				]);
			}
		}
	}

	public function showServices() {
		$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_SERVICE)->first();
		$data = array();
		$data['meta_tag'] = $tag;
		return view('front.new_service', $data);
	}

	public function getContent($machine_name){
	//	$route_urlname=Route::getCurrentRoute()->uri();
		$page = Page::where('machine_name', $machine_name)->first();
		$tag = '';

		if($machine_name == 'about-us') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_ABOUT)->first();
		}
		if($machine_name == 'contact-us') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_CONTACT_US)->first();
		}
		if($machine_name == 'terms-service') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_TERMS_SERVICE)->first();
		}
		if($machine_name == 'privacy-policy') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_PRIVACY_POLICY)->first();
		}
		if($machine_name == 'cookies-policy') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_COOKIES_POLICY)->first();
		}
		if($machine_name == 'code-ethics') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_CODE_ETHICS)->first();
		}
		if($machine_name == 'servicesb') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_SERVICESB)->first();
		}
		if($machine_name == 'global-orientation-test') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_GLOBAL_ORIENTATION)->first();
		}
		if($machine_name == 'professional-kit') {

			// if auth user already payed --> must avoid payment page!
			if (Auth::user() && !Auth::user()->isConsultant()) {
				
				$user_id = Auth::user()->id;
				$order = Order::where('user_id', $user_id)->where('deleted_at', NULL)->get();
				
				if (count($order) > 0) {
					return redirect()->route('professional.kit.step');
				}
			}

			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_PROFESSIONAL_KIT)->first();
		}
		if($machine_name == 'global-toolbox') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_GLOBAL_TOOLBOX)->first();
		}
		if($machine_name == 'skills-development') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_SKILLS_DEVELOPMENT)->first();
		}
		if($machine_name == 'aiesec') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_AIESEC)->first();
		}
		if($machine_name == 'faq') {
			$tag = MetaTags::where('page_type',MetaTags::PAGE_TYPE_FAQ)->first();
		}

		$data['machine_name'] = $machine_name;

		$data['meta_tag'] = $tag;
		if(!isset($page->page_title)) {
			$data['page_title']='Page 404 not found';
			$data['desc']='';
		} else {
			$data['page_title']=$page->page_title;
			$data['desc']=$page->description;
		}

		return view('front.pages',$data);
	}
	public function thankYouPage($service_id){
		$data['page_title'] = 'Thank You';
		$data['service_id'] = $service_id;
		return view('front.thankyou',$data);
	}
	public function contactform(){
		$route_urlname=Route::getCurrentRoute()->uri();
		$contact_page = Page::where('machine_name', $route_urlname)->first();
		$data['page_title']=$contact_page->page_title;
		$data['desc']=$contact_page->description;
		$meta_tag = MetaTags::where('page_type', MetaTags::PAGE_TYPE_CONTACT_US)->first();
		$data['meta_tag'] = $meta_tag;
		return view('front.contactus',$data);
	}

	public function contact_send_email(Request $request) {
		$rules['name'] = 'required';
		$rules['email'] = 'required|email|max:255';
		$rules['subject'] = 'required';
		$rules['message'] = 'required';
		$rules['policy'] = 'required';

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}

		$website_email = '';
		$data['contact_form_data'] = $request;

		$mytime = Carbon\Carbon::now();
		$current_date = $mytime->toDateTimeString();
		$data['current_date'] = $current_date;
		Mail::send('emails.contactus', $data, function ($m) {
			$settings=Setting::find(1);
			$website_email = $settings['website_email'];
            $m->from($website_email, 'Wexplore');

            $m->to($website_email, 'Wexplore')->subject('New Contact Us Form Submission');
        });
		return redirect('contact-us')->with('status', 'Your message has been sent successfully!');
	}

	public function client_dashboard() {

		$all_notifications = [];
		$dash_noti = [];

		//INIZIO - Professional Kit status
		$order = Order::where('user_id',Auth::user()->id)->where('item_name','Professional Kit')->first();
		if($order != null) {

			if ($order->step_id == -1) {
				$dash_noti[] = ['heading' => 'Start Process',
								'noti_msg' => link_to_route("professional.kit", "Click here", array(), array("class" => "")) . ' to begin the process.',
								'noti_url' => '',
								];
			}

			if ($order->step_id == 0) {
				$dash_noti[] = ['heading' => 'Market Analysis',
								'noti_msg' => link_to_route("market_analysis", "Click here", array(), array("class" => "")) . ' to proceed the First step.',
								'noti_url' => ''
								];
			}

			if ($order->step_id == 1) {
				$dash_noti[] = ['heading' => 'Culture Match',
								'noti_msg' => link_to_route("culture_match", "Click here", array(), array("class" => "")) . ' to proceed the Second step.',
								'noti_url' => ''
								];
			}

			if ($order->step_id == 2) {
				$dash_noti[] = ['heading' => 'Culture Match',
								'noti_msg' => link_to_route("culture_match", "Click here", array(), array("class" => "")) . ' please complete the Second step to move further.',
								'noti_url' => ''
								];
			}

			if ($order->step_id == 3) {
				$dreamcheck_lab = DreamCheckLab::where('user_id', Auth::user()->id)->first();
				$noti_url = '';
				$heading = "Dream Check Lab";
				if ($dreamcheck_lab != null)
					if ($dreamcheck_lab->state_id == DreamCheckLab::STATE_COMPLETED) {
						$noti_url = url('user/' . $dreamcheck_lab->id . '/download');
						$heading = "Wait For Consultant Feedback";
					}

					$dash_noti[] = ['heading' => $heading,
					'noti_msg' => link_to_route("dream.check.lab", "Click here", array(), array("class" => "")) . ' to proceed to the third step.',
					'noti_url' => $noti_url];
			}

			if ($order->step_id == 4) {
				$dreamcheck_lab = DreamCheckLab::where('user_id', Auth::user()->id)->first();
				$validate_by = $dreamcheck_lab->validate_by;  // se crea errore (nei test!) --> in DB: "Orders" tab.--> step_id = 3 o meno

				$consultant = User::find($validate_by);
				$consultant_name = '';

				if (!empty($consultant) && is_object($consultant)) {
					$consultant_name = $consultant->name;

					if (!empty($consultant->surname)) {
						$consultant_name .= ' ' . $consultant->surname;
					}
				}

				$user_id = Auth::user()->id;
				$bookings = ConsultantBooking::where('user_id', $user_id)
				->where('status','!=',0)
				->where('type_id', ConsultantBooking::TYPE_INTERVIEW)  // 0 --> career orientation session
				->get();

				if ($bookings == null || count($bookings) == 0) {
					$number = 'first';
				}elseif(count($bookings) == 1) {
					$number = 'second';
				} else {
					$number = '{-error-}';
				}

				$dash_noti[] = ['heading' => 'Career Orientation Session',
				'noti_msg' => 'Your Dream Check Lab form has been validated by <b>' . $consultant_name . '</b>. To check consultant feedback ' . link_to_route("user.mydocuments", "Click here", [], array("class" => "")) . '.<br/>Please proceed to book your <b>'.$number.'</b> session Call with your consultant or go to your "<a href="/user/steady_aim_shoot" target="_blank"><b>Steady Aim Shoot</b></a>" section to view your Documents.<br/><a style="margin-top:15px;" class="btn btn-lg btn-success" href="' . url('user/role_play_interview') . '">CAREER ORIENTATION SESSION <span class="glyphicon glyphicon-chevron-right"></span></a>',
				'noti_url' => ''];
			}

			if ($order->step_id == 5) {
				$dash_noti[] = ['heading' => 'Steady Aim Shoot',
								'noti_msg' => link_to_route("steady_aim_shoot", "Click here", array(), array("class" => "")) . ' to proceed to last step.',
								'noti_url' => ''];
			}

			//Check Culture match
			$culture_match = CultureMatchSurvey::where('user_id',\Auth::user()->id)->first();

			if($culture_match != null) {
				if ($culture_match->is_pdf_sent == 1) {
					$dash_noti [] = [
						'heading' => 'Culture Match Survey',
						'noti_msg' => link_to_route('user.mydocuments', 'Click here') . '. To download your culture match survey feedback.',
						'noti_url' => ''
					];
				}
			}

			$all_notifications[] = [
				'heading' => 'Professional Kit',
				'notifications' => $dash_noti
			];
		}
		// FINE - Professional Kit Status

		$roles = array();
		if(Auth::user()->userRoles){
			$user_role = Auth::user()->userRoles;
			foreach($user_role as $r){
				$roles[]=$r->role_id;
			}
		}

		$services=array();
		$user_id=Auth::user()->id;
		$user_free_service=Service::where('type','free')->first();
		$services[]=$user_free_service->id;
		$user_services=Order::where('user_id',$user_id)->where('item_type','service')->get();

		foreach($user_services as $user_service){
			$services[]=$user_service->item_id;
		}

		$services_obj=Service::whereIn('id',$services)->get();
		$user_services=array();

		// modifica 12/04/2019 
		$services_obj = Service::whereIn('id', [1,5,6,7])->get();  // 1,5,6,7 sono gli id dei nuovi servizi !!
		$services_purchased_by_user = Order::where('user_id',$user_id)->pluck('item_name'); 
		$services_purchased_by_user_arr = [];
		foreach ($services_purchased_by_user as $k => $service_name) {
			$services_purchased_by_user_arr[] = $service_name;
		}

		if($services_obj->count() > 0){
			foreach($services_obj as $service){
				$url = '';
				$label = 'start';

				if($service->name == 'Skill Development') {
					$url = url('skill_development/browse');
				}elseif($service->name == 'Global Orientation Test') {
					$url = url('/global_orientation_test');
				}elseif($service->name == 'Global Toolbox') {
					$url = url('/global_toolbox');
				}elseif($service->name == 'Professional Kit') {
					$url = url('/professional_kit');
				}elseif ($service->name == 'Global Orientation Test PRO') {
					$url = url('/user/got-pro');
				}elseif ($service->name == 'Career Ready') {
					$url = 'http://eepurl.com/grpRwb'; //url('/user/career-ready');
				}elseif ($service->name == 'WOW') {
					$url = 'http://eepurl.com/grpRwb'; //url('/user/wow');
				}

				$label = in_array($service->name, $services_purchased_by_user_arr) ? 'start' : 'buy';
				
				$user_services[$service->id]=array(
					'purchased'=>'yes',
					'name'=>$service->name,
					'image'=>$service->image,
					'user_dashboard_image'=>$service->user_dashboard_image,
					'price'=>$service->price,
					'description'=>$service->description,
					'user_dashboard_desc'=>$service->user_dashboard_desc,
					'url' => $url,
					'label' => $label,
				);
			}
		}


		$unpaid_services_obj=Service::whereNotIn('id',$services)->get();
		$user_unpaid_services=array();


		if($unpaid_services_obj->count() > 0){

			foreach($unpaid_services_obj as $unpaid_service){
				$url = '';
				if($unpaid_service->name == 'Skill Development') {
					$url = url('skill_development/browse');
				}elseif($unpaid_service->name == 'Global Orientation Test') {
					$url = url('/global_orientation_test');
				}elseif($unpaid_service->name == 'Global Toolbox') {
					$url = url('/global_toolbox');
				}elseif($unpaid_service->name == 'Professional Kit') {
					$url = url('/professional_kit');
				}
				$user_unpaid_services[$unpaid_service->id]=array(
					'purchased'=>'no',
					'name'=>$unpaid_service->name,
					'image'=>$unpaid_service->image,
					'user_dashboard_image'=>$unpaid_service->user_dashboard_image,
					'price'=>$unpaid_service->price,
					'description'=>$unpaid_service->description,
					'user_dashboard_desc'=>$unpaid_service->user_dashboard_desc,
					'url' => $url
				);
			}
		}

		$data['page_title']='Dashboard';
		$data['user_roles']=$roles;
		$data['user_services']=$user_services;
		$data['user_unpaid_services'] = $user_unpaid_services;
		$data['notifications'] = $all_notifications;

		return view('client.client_dashboard',$data);

	}






	public function services(){
		$roles = array();
		if(Auth::user()->userRoles){
			$user_role = Auth::user()->userRoles;
			foreach($user_role as $r){
				$roles[]=$r->role_id;
			}
		}
		$services=array();
		$user_id=Auth::user()->id;
		$user_free_service=Service::where('type','free')->first();
		$services[]=$user_free_service->id;
		$user_services=Order::where('user_id',$user_id)->where('item_type','service')->get();
		foreach($user_services as $user_service){
			$services[]=$user_service->item_id;
		}
		$services_obj=Service::whereIn('id',$services)->get();
		$user_services=array();
		if($services_obj->count() > 0){
			foreach($services_obj as $service){
                $url = '';
                if($service->name == 'Skill Development') {
                    $url = url('skill_development/browse');
                }elseif($service->name == 'Global Orientation Test') {
                    $url = url('/global_orientation_test');
                }elseif($service->name == 'Global Toolbox') {
                    $url = url('/global_toolbox');
                }elseif($service->name == 'Professional Kit') {
                    $url = url('/professional_kit');
                }
				$user_services[$service->id]=array(
																		'purchased'=>'yes',
																		'name'=>$service->name,
																		'image'=>$service->image,
																		'user_dashboard_image'=>$service->user_dashboard_image,
																		'price'=>$service->price,
																		'description'=>$service->description,
																		'user_dashboard_desc'=>$service->user_dashboard_desc,
                                                                        'url' => $url,
																		);
			}
		}
		$unpaid_services_obj=Service::whereNotIn('id',$services)->get();
		if($unpaid_services_obj->count() > 0){
			foreach($unpaid_services_obj as $unpaid_service){
                $url = '';
                if($unpaid_service->name == 'Skill Development') {
                    $url = url('skill_development/browse');
                }elseif($unpaid_service->name == 'Global Orientation Test') {
                    $url = url('/global_orientation_test');
                }elseif($unpaid_service->name == 'Global Toolbox') {
                    $url = url('/global_toolbox');
                }elseif($unpaid_service->name == 'Professional Kit') {
                    $url = url('/professional_kit');
                }
				$user_services[$unpaid_service->id]=array(
													'purchased'=>'no',
													'name'=>$unpaid_service->name,
													'image'=>$unpaid_service->image,
													'user_dashboard_image'=>$unpaid_service->user_dashboard_image,
													'price'=>$unpaid_service->price,
													'description'=>$unpaid_service->description,
													'user_dashboard_desc'=>$unpaid_service->user_dashboard_desc,
                                                    'url' => $url
													);
			}
		}
		$data['page_title']='Dashboard';
		$data['user_roles']=$roles;
		$data['user_services']=$user_services;
		$meta_tag = MetaTags::where('page_type', MetaTags::PAGE_TYPE_SERVICE)->first();
		$data['meta_tag'] = $meta_tag;
		return view('client.services',$data);
	}

	public function global_online_test_intro() {

		return view('front.global_test_intro');
	}

	public function global_online_test(Request $request){

		$question=GlobalTest::first();  // first question in survey
		$question_data=array('id' => $question->id,
						'question' => $question->question,
						'parent_choice' => $question->parent_choice,
						'choice'=>$question->questionChoices,
						);

		$global_test_compiled_yet = false;
		$outcome_data=array();
		$user_id = Auth::user()->id;
		$compiled = GlobalTestResult::where('user_id', $user_id)->get();

		$query_string = $request->query('force');
		
		if(count($compiled) > 0 && $query_string != 'recompile') {  // .. and NOT force=recompile ..
			$global_test_compiled_yet = true;
			$outcome_id = $compiled->first()->outcome_id;
			$outcome = GlobalTestOutcomes::where('id', $outcome_id)->first();
			$outcome_data=array('id' => $outcome->id,
							'outcome_name' => $outcome->outcome_name,
							'outcome_image' => $outcome->outcome_image,
							'outcome_file' =>$outcome->outcome_file,
							'description' => $outcome->description,
							);			
		}

		$data['page_title']='';
		$data['question']=$question_data;
		$data['last_question']=false;
		$data['global_test_compiled_yet'] = $global_test_compiled_yet;
		$data['outcome_data'] = $outcome_data;

		return view('front.global_test',$data);
	}




	public function global_online_test_next(Request $request){
		$validator = Validator::make($request->all(), [
            'choice' => 'required',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }

		$outcome_data=array();
		$question_data=array();
		$last_question=false;
		$choice_id=$request['choice'];  // es 19 for LAST input
		$question_id=$request['question_id'];
		$question=GlobalTest::where('parent_choice',$choice_id)->first();   // for LAST question : null

		// first questions
		if(!empty($question)){  // not last question
			
			$question_data = array('id' => $question->id,
						'question' => $question->question,
						'parent_choice' => $question->parent_choice,
						'choice' => $question->questionChoices,  // foreign key
						);
		} else {  // last question
			
			$outcome=GlobalTestOutcomes::where('choice_id',$choice_id)->first();

			if(empty($outcome)){
				$outcome_data=array('id' => '',
							'outcome_name' => 'Anonymous',
							'outcome_image' => '',
							'outcome_file' =>'',
							'description' => '',
							);
			} else {
				$outcome_data=array('id' => $outcome->id,
							'outcome_name' => $outcome->outcome_name,
							'outcome_image' => $outcome->outcome_image,
							'outcome_file' =>$outcome->outcome_file,
							'description' => $outcome->description,
							);
				$user_id=Auth::User()->id;
				$global_test=GlobalTestResult::create(['user_id'=>$user_id,'outcome_id'=>$outcome->id]);




				// admin notification
				$user = User::findOrFail($user_id);
		        Mail::send('emails.global_orient_test_admin_notif', ['user' => $user], function($m) use ($user) {
					$site_email = Setting::find(1)->website_email;			
					$admin_emails = User::getNotificationList();

		            $m->from($site_email, 'Wexplore');
		            $m->to($admin_emails)->subject('New user completed Global Orientation Test');
		        });




			}
			$last_question=true;
		}


		$data['page_title']='';
		$data['question']=$question_data;
		$data['outcome_data']=$outcome_data;
		$data['last_question']=$last_question;
		$data['global_test_compiled_yet']=false;

		return view('front.global_test',$data);
	}



	public function partners() {
		$partners = Partners::all();
		$data['page_title'] = 'Our Partners';
		$data['partners'] = $partners;
		$meta_tag = MetaTags::where('page_type', MetaTags::PAGE_TYPE_PARTNERS)->first();
		$data['meta_tag'] = $meta_tag;
		return view('front.partners',$data);
	}

	public function getDownload($file_name) {
		$file_name = base64_decode($file_name);
		$file= base_path().'/../'.$file_name;
		$name = basename($file_name);
		$headers = array(
			'Content-Type: Image/Jpeg',
		);
		if(strstr($file_name, '.pdf')) {
			$headers = array(
				'Content-Type: application/pdf',
			);
		}

		return response()->download($file, $name, $headers);
	}

	public function service_send_email(Request $request) {
		$serviceId = $request->service_id;

		$rules['name'] = 'required';
		$rules['surname'] = 'required';
		$rules['address'] = 'required';
		$rules['email'] = 'required|email|max:255';
		$rules['policy'] = 'required';
		if($serviceId == 1 || $serviceId == 2) {
			$rules['message'] = 'required';
		}

		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}

		$service = Service::where('id', $serviceId)->first();

		$website_email = '';
		$data['contact_form_data'] = $request;

		$mytime = Carbon\Carbon::now('Europe/Rome'); // added Europe/Rome timezone
		$current_date = $mytime->toDateTimeString();
		$data['current_date'] = $current_date;
		$data['service_name'] = $service->name;

		$mailchimpGroup = '';
		if($serviceId == 1) { $mailchimpGroup = PagesController::MAILCHIMP_LIST_GROUP_GLOBAL_ORIENTATION_TEST; }
		if($serviceId == 2) { $mailchimpGroup = PagesController::MAILCHIMP_LIST_GROUP_PROFESSIONAL_KIT; }
		if($serviceId == 3) { $mailchimpGroup = PagesController::MAILCHIMP_LIST_GROUP_SKILLS_DEVELOPMENT; }
		if($serviceId == 4) { $mailchimpGroup = PagesController::MAILCHIMP_LIST_GROUP_GLOBAL_TOOLBOX; }

		$esito = $this->updateMailchimp($request->name, $request->surname, $request->address, $request->email, $mailchimpGroup);

		Mail::send('emails.service_email', $data, function ($m) {
			$settings=Setting::find(1);
			$website_email = $settings['website_email'];
			$m->from($website_email, 'Wexplore');
			$m->to($website_email, 'Wexplore')->subject('New Service Contact Us Form Submission');
		});
		return redirect()->back()->with('status', 'Your message has been sent successfully!');
	}

	public function aiesec_send_email(Request $request) {
		$rules['name'] = 'required';
		$rules['surname'] = 'required';
		$rules['address'] = 'required';
		$rules['email'] = 'required|email|max:255';
		$rules['policy'] = 'required';
		$rules['message'] = 'required';

		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}

		$website_email = '';
		$data['contact_form_data'] = $request;

		$mytime = Carbon\Carbon::now();
		$current_date = $mytime->toDateTimeString();
		$data['current_date'] = $current_date;
		$data['service_name'] = 'AIESEC';

		$mailchimpGroup = PagesController::MAILCHIMP_LIST_GROUP_AIESEC;

		$esito = $this->updateMailchimp($request->name, $request->surname, $request->address, $request->email, $mailchimpGroup);
		Mail::send('emails.service_email', $data, function ($m) {
			$settings=Setting::find(1);
			$website_email = $settings['website_email'];
			$m->from($website_email, 'Wexplore');
			$m->to($website_email, 'Wexplore')->subject('New AIESEC Contact Us Form Submission');
		});

		Mail::send('emails.aiesec_user_email', $data, function ($m) use($request) {
			$settings=Setting::find(1);
			$website_email = $settings['website_email'];
			$m->from($website_email, 'Wexplore');
			$m->to($request->email, $request->name)->subject('Benvenuto in Wexplore: il tuo viaggio comincia da qui');
		});

		return redirect()->back()->with('status', 'Your message has been sent successfully!');
	}

	private function updateMailchimp($name, $surname, $address, $email, $group) {
      $apiKey = env('MC_API_KEY', 'NO_APIKEY'); 
      $listId = env('MC_LIST_ID', 'NO_LISTID'); 
      $emailHash = md5(strtolower($email));

      $endpoint = "https://us13.api.mailchimp.com/3.0/lists/" . $listId . "/members/". $emailHash;
      $requestBody = array(
	       "email_address" => $email,
	       "status" => "subscribed",
	       "merge_fields" => array(
	           	"FNAME" => $name,
	           	"LNAME" => $surname,
				"ADDRESS" => $address
	       ),
	       'interests' => array(
	           $group => true
	       )
	   );

      $connection = curl_init($endpoint);
      curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($connection, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($connection, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($connection, CURLOPT_USERPWD, "mailchimp:" . $apiKey);
      curl_setopt($connection, CURLOPT_POSTFIELDS, json_encode($requestBody));

      $response = curl_exec($connection);
      curl_close($connection);

		Log::info(print_r($response, true));

		return;
	}

}
