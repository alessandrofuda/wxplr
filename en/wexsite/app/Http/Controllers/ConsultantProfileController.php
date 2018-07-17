<?php

namespace App\Http\Controllers;

use App\GlobalToolQuery;
use App\Order;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use Validator;
use App\ConsultantAvailablity;
use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;
use App\ConsultantProfile;
use App\ConsultantBooking;
use App\Country;
use App\DreamCheckLab;
use App\DreamCheckLabFeedback;
use Mail;
use App\Setting;
use App\UserConsultantDiscussion;
use Log;


class ConsultantProfileController extends CustomBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noti_mesg = '';
        $user = Auth::user();
        $consultant_profile = $user->consultantProfile();
        $consultant_obj = [];
        $consultant_obj_arr = $consultant_profile->first(['country_expertise']);

        if($consultant_obj_arr != null) {
            $consultant_obj = $consultant_obj_arr->toArray();
            $consultant_expertise_country = $consultant_obj['country_expertise'];
        }

        $dreamcheck_lab = DreamCheckLab::where('validate', 0)
                                        ->where('validate_by',$user->id)->get()->toArray();
        if(!empty($dreamcheck_lab)){

            foreach($dreamcheck_lab as $dream_check) {
                $noti_mesg = "An user has submitted the Dream Check Form in your expertise country. ".link_to_route('dreamcheck.lab.submission', 'Click here', array($dream_check['id']), array('class' => '')) ." to check submission and give feedback.";
            }

        }else {
            $noti_mesg = 'No matching Dream Check Lab submission found!!';
        }

        $data['dreamcheck_lab'] = $dreamcheck_lab;
        $data['noti_mesg'] = $noti_mesg;
        $data['page_title'] = 'Dashboard';

        return view('consultant.consultant_dashboard',$data);
    }

    public function availability_form(){
        $data['page_title'] = 'Consultant Availablity Form';
        $data['page_type']='view';

        // box discussion between consultant and client/clients(!)  I clienti possono essere più di uno per ogni consultant ??
        $consultant = Auth::user();
        $client_id = DreamCheckLab::where('validate_by', $consultant->id ) 
                                    // ->where('validate', 1) // se viene aperto prima della validazione --> genera errore !
                                    ->orderBy('updated_at', 'desc')
                                    ->first();


        if($client_id !== NULL ) {
                                        
            $client_id = $client_id->user_id;  
            $client = User::findOrFail($client_id);
            $data['client'] = $client;
            $discuss_id = $client->id.$consultant->id;
            $data['discuss_id'] = $discuss_id;
            $discussions = UserConsultantDiscussion::whereIn('user_id', [$client->id, $consultant->id])
                                                   ->where('discuss_id', $discuss_id)
                                                   ->orderBy('created_at', 'asc')
                                                   ->get();
            $data['discussions'] = $discussions;
        
        }

        return view('consultant.consultant_availability_form',$data);
    }
    

    public function events(){
        $data['page_title'] = 'Assigned Events';
        $events = \App\Event::where('consultant_id',Auth::user()->id)->get();
        $data['events'] = $events;

        return view('consultant.consultant_events_list',$data);
    }

    public function post_availability_form(Request $request) {
        
        $user_id = Auth::user()->id;
       
		$request_arr['available_date'] = 'required';
        $request_arr['available_start_time'] = 'required';
        $request_arr['available_end_time'] = 'required';
        $request_arr['status'] = 'required';
        $request_arr['type_id'] = 'required';
        
        $validator = Validator::make($request->all(), $request_arr);

        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }


        $title = '';
        $available_date = trim($request['available_date']);
        $available_start_time = trim($request['available_start_time']); 
        $available_end_time = trim($request['available_end_time']);

        $available_date_time =  date('Y-m-d',strtotime($available_date)).' '.date('H:i:s',strtotime($available_start_time));

        $available_date_utc = Setting::dateUtc($available_date_time);

        $available_start_utc = Setting::dateUtc($available_date_time, true);  
        
        $available_end_date_time =  date('Y-m-d',strtotime($available_date)).' '.$available_end_time;
        $available_end_utc = Setting::dateUtc($available_end_date_time, true);

        $status = $request['status'];

        if ($available_start_time > $available_end_time ) {
            return redirect()->back()->withInput()->with('error', 'Start time must be less then end time');
        }
        
        $consultant_avail = array('consultant_id'=>$user_id,
                                'title'=>$title,
                                'available_date'=>strtotime($available_date_utc),
                                'available_start_time'=>$available_start_utc,
                                'available_end_time'=>$available_end_utc,
                                'type_id' => $request->get('type_id'),
                                'status'=>$status);

        $availablity = ConsultantAvailablity::where('available_date', strtotime($available_date_utc))
                                            ->where('consultant_id', $user_id)
                                            ->where(function($q1) use ($available_start_utc, $available_end_utc) {
                                                    $q1
                                                    ->whereBetween('available_start_time', [$available_start_utc, $available_end_utc])
                                                    ->orWhereBetween('available_end_time', [$available_start_utc, $available_end_utc]);
                                                    })
                                            ->first();

        if($availablity != null) {
            return  redirect()->back()->withInput()->with('error', 'These timings are clashing with other availablity timings. Please choose other timings.');
        }

        $ca = ConsultantAvailablity::Create($consultant_avail);  // !! orari salvati in db in UTC



        // invio mail a client
        if($ca){
            $consultant_id = $ca->consultant_id;
            $dream_check_lab_obj = DreamCheckLab::where('validate_by', $consultant_id)
                                        ->where('validate', 1)
                                        ->orderBy('updated_at', 'desc')
                                        ->first();

            if($dream_check_lab_obj !== null) {
                $client_id = $dream_check_lab_obj->user_id;

                $client = User::find($client_id);
                $client_name = $client->name.' '.$client->surname;
                $client_email = $client->email;

                $consultant = User::find($consultant_id);
                $consultant_name = $consultant->name.' '.$consultant->surname;

                $type = $ca::getAvailabilityType($ca->type_id);



                Mail::send('emails.consultant_availability_notification', ['client_id' => $client_id, 'client_name' => $client_name, 'consultant_name' => $consultant_name, 'ca' => $ca, 'type' => $type], function ($m) use ($client_email, $client_name) { 
                        $settings = Setting::find(1);
                        $site_email = $settings->website_email;
                        $m->from($site_email, 'Wexplore');
                        $m->to($client_email, $client_name)->subject('Confirm your date availability!');
                    });
            } else {

                return  redirect()->back()->withInput()->with('error', 'No match found with user. You have not validated Dream Check Lab User yet.');

            }
            
        }



        return redirect('consultant/availability/list')->with('status', 'Form has been saved and Call scheduled!');
    }


    public function availability_list(){
		$user_id = Auth::user()->id;
        $consultant_avails = ConsultantAvailablity::where('consultant_id',$user_id)->get();
        $data['page_title'] = 'Consultant Availablity Listing';
        $data['consultant_avails'] = $consultant_avails;

        // dd($data['consultant_avails']); // OK!

        return view('consultant.consultant_availability_list',$data);
    }

    public function edit_availability_form($id){
        $data['page_title'] = 'Consultant Availablity Form';
        $edit_availability = ConsultantAvailablity::find($id);        
        $data['page_type']='edit';
        $data['edit_availability'] = $edit_availability;
      //  echo '<pre>';print_r($edit_availability);exit;

        // box discussion between consultant and client/clients(!)  I clienti possono essere più di uno per ogni consultant ??
        $consultant = Auth::user();
        $client_id = DreamCheckLab::where('validate_by',$consultant->id)  // ::where('validate', 1)
                                    ->first(['user_id'])
                                    ->user_id;
        $client = User::find($client_id);
        $data['client'] = $client;
        $discuss_id = $client->id.$consultant->id;
        $data['discuss_id'] = $discuss_id;
        $discussions = UserConsultantDiscussion::whereIn('user_id', [$client->id, $consultant->id])
                                               ->where('discuss_id', $discuss_id)
                                               ->get();
        $data['discussions'] = $discussions;
        

        return view('consultant.consultant_availability_form',$data);
    }

    public function update_availability_form(Request $request, $id){
        $user_id = Auth::user()->id;
       // $request_arr['title'] = 'required';
		$request_arr['available_date'] = 'required';
        $request_arr['available_start_time'] = 'required';
        $request_arr['available_end_time'] = 'required';
        $request_arr['status'] = 'required';
        $request_arr['type_id'] = 'required';
        
        $validator = Validator::make($request->all(), $request_arr);

        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $title = '';
        $available_date = trim($request['available_date']);
        $available_start_time = trim($request['available_start_time']);
        $available_end_time = trim($request['available_end_time']);

        $available_date_time =  date('Y-m-d',strtotime($available_date)).' '.date('H:i:s',strtotime($available_start_time));

        $available_date_utc = Setting::dateUtc($available_date_time);

        $available_start_utc = Setting::dateUtc($available_date_time, true);


        $available_end_date_time =  date('Y-m-d',strtotime($available_date)).' '.$available_end_time;
        $available_end_utc = Setting::dateUtc($available_end_date_time, true);

        $status = $request['status'];
        
        $consultant_avail = array('consultant_id'=>$user_id,
                               'title'=>$title,
                                'available_date'=>strtotime($available_date_utc),
                                'available_start_time'=>$available_start_utc,
                                'available_end_time'=>$available_end_utc,
                               'type_id' => $request->get('type_id'),
                               'status'=>$status);
        $ca = ConsultantAvailablity::find($id);
        $ca->update($consultant_avail);

        $meeting = ConsultantBooking::where('availablity_id', $ca->id)->first();

        if($meeting != null) {
            $meeting->updateMeeting();
            $ConsultantBooking = ConsultantBooking::where('availablity_id',$ca->id)->first();

            if($ConsultantBooking != null) {
                \Mail::send('emails.consultant_booking', ['user' => $ConsultantBooking->user, 'consultantbooking' => $ConsultantBooking], function ($m) use ($ConsultantBooking) {
                    $settings = Setting::find(1);
                    $site_email = $settings->website_email;
                    $m->from($site_email, 'Wexplore');
                    $m->to($ConsultantBooking->user->email, $ConsultantBooking->user->name)->subject('Consultant Booking!');
                });
            }
        }

        return redirect('consultant/availability/list')->with('status', 'Form has been updated!');
    }

    public function destroy_availability($id){
        $ca = ConsultantAvailablity::find($id);
        $ca->delete();		

        return redirect('consultant/availability/list')->with('status', 'Availability has been deleted!');
    }

	public function appoinment_listing(){
		$avail_ids = array();
        $appointments = array();
		$user_id = Auth::user()->id;
		$data['page_title']='Appoinment Listing';
		$consultants_avails = ConsultantAvailablity::where('consultant_id',$user_id)->get();

        if(count($consultants_avails) > 0){

            foreach($consultants_avails as $ca){
				$avail_ids[] = $ca['id'];
			}

            $appointments = ConsultantBooking::whereIn('availablity_id',$avail_ids)->get();
		}

		//echo '<prE>';print_r($booked_consultants);exit;
		$data['appointments'] = $appointments;

		return view('consultant.consultant_appoinment_list',$data);
	}

    public function cancel_booking($id) {
        $booking = ConsultantBooking::find($id);
        $booking->update(
            ['status' => ConsultantBooking::STATE_CANCELLED]
        );
        $booking->cancelMeeting();


        $booking->availablity->update(
             ['status' => 0]);

        $data['message'] = 'Booking have been cancelled by consultant';
        $data['name'] = $booking->user->name;
        $data['b_id'] = $booking->id;
        $data['type'] = $booking->type_id;
        $to_email = $booking->user->email;

        Mail::send('emails.booking_cancel_notification', $data, function ($m) use ($to_email) {
            $settings=Setting::find(1);
            $site_email = $settings->website_email;
            $m->from($site_email, 'Wexplore');
            $m->to($to_email, 'Wexplore')->subject('Successfully Cancelled!');
        });

        return redirect()->back()->with('success', 'Successfully Cancelled');
    }

    public function dreamcheck_lab_forms() {
        $data['page_title'] = 'Dream Check Lab Forms';
        $forms = DreamCheckLab::where('validate_by',Auth::user()->id)->get();
        $data['forms'] = $forms;

        return view('consultant.consultant_forms_list',$data);
    }

    public function consultant_forms() {

        $data['page_title'] = 'Assigned User Listing';
        $dream_check_lab_forms = DreamCheckLab::where('validate_by', Auth::user()->id)->get();
        $global_tool_forms = GlobalToolQuery::where('consultant_id', Auth::user()->id)->get();
        $data['forms'] = [];

        foreach ($dream_check_lab_forms as $dream_check_lab_form) {
            
            $feedback = DreamCheckLabFeedback::where('dream_check_lab_id', $dream_check_lab_form->id)->first();

            if(isset($dream_check_lab_form->createUser)){
                $data['forms'][] = [
                    'user_name' => link_to_route('form_user_profile', $dream_check_lab_form->createUser->name,
                        ['service_id' => $dream_check_lab_form->id, 'service_type' => ConsultantBooking::TYPE_INTERVIEW]),
                    'service_type' => 'Role Play Interview',
                    'form' =>$feedback != null ? link_to_route('dreamcheck.lab.submission.feedback','Feedback Completed', ['dreamcheck_id' => $dream_check_lab_form->id]) : link_to_route('dreamcheck.lab.submission.feedback','Give Form Feedback', ['dreamcheck_id' => $dream_check_lab_form->id]),
                    'attached_file' => $dream_check_lab_form->cv_file != null ? link_to_asset($dream_check_lab_form->cv_file) : "Not Uploaded",
                    'booking_date' =>  $dream_check_lab_form->getBookingDate(),  
                    'booking_status' => $dream_check_lab_form->getBookingStatus(),
                    'submitted_on' => $dream_check_lab_form->created_at
                ];
            }
            
        }

        foreach ($global_tool_forms as $global_tool_form) {
            if(isset($global_tool_form->user->name)) {
                $data['forms'][] = [
                    'user_name' => link_to_route('form_user_profile', $global_tool_form->user->name,
                        ['service_id' => $global_tool_form->id, 'service_type' => ConsultantBooking::TYPE_QUERY]),
                    'service_type' => $global_tool_form->getQuestionTypeOptions($global_tool_form->question_type_id),
                    'form' => $global_tool_form->getBookingstatus() != 'NOK' ? $global_tool_form->feedback != null ? link_to_route('global_tool_form_feedback', 'Feedback Completed', ['global_tool_form' => $global_tool_form->id]) : link_to_route('global_tool_form_feedback', 'Give Feedback', ['global_tool_form' => $global_tool_form->id]) : "Booking Cancelled",
                    'attached_file' => $global_tool_form->attach_file != null ? link_to_asset($global_tool_form->attach_file) : "Not uploaded",
                    'booking_date' => $global_tool_form->getBookingDate(),
                    'booking_status' => $global_tool_form->getBookingStatus(),
                    'submitted_on' => $global_tool_form->created_at
                ];
            }
        }

        usort( $data['forms'], function ($item1, $item2) {
            if ($item1['submitted_on'] == $item2['submitted_on']) return 0;

            return $item1['submitted_on'] < $item2['submitted_on'] ? -1 : 1;
        });



        return view('consultant.consultant_forms', $data);
    }





    public function global_tool_form_feedback($id) {
        $globalToolBoxQuery = GlobalToolQuery::find($id);
        $data ['page_title'] = 'Global Tool Query Feedback Form';
        $data['query'] = $globalToolBoxQuery;
        $data['noti_mesg'] = '';
        return view('consultant.global_tool_query_feedback', $data);
    }

    public function global_tool_form_feedback_store(Request $request, $id) {
        $globalToolBoxQuery = GlobalToolQuery::find($id);

        $rules = [
            'feedback' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->back()->withErrors();
        }

        $globalToolBoxQuery->update([
            'feedback' => $request->get('feedback')
        ]);


        return redirect('consultant/global_tool_form/feedback/'.$id)->with('status', 'Feedback Submitted successfully');
    }

    public function form_user_profile($id, $type) {
        $data['page_title'] = "User Profile";
        $data['noti_mesg'] = "";
        if($type == ConsultantBooking::TYPE_INTERVIEW) {
            $dream = DreamCheckLab::find($id);
            $user = $dream->createUser;
            $data['user'] = $user;
            $data['page_title'] = "User Profile: ".$user->name;
            $dream_feedback = DreamCheckLabFeedback::where('dream_check_lab_id', $id)->first();
            $data['dream_check_lab_feedback'] = $dream_feedback;
        }

        if($type == ConsultantBooking::TYPE_QUERY) {
            $query = GlobalToolQuery::find($id);
            $user = $query->user;
            $data['user'] = $user;
            $data['page_title'] = "User Profile: ".$user->name;
            $query_feedback = $query;
            $data['query_feedback'] = $query_feedback;
        }

        return view('consultant.form_user_profile', $data);
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

	public function consultant_show()
    {
        $data['page_title']='Consultant Profile';
        $cc_code=Country::all();
        $data['countries_code'] = $cc_code;
        $model = new ConsultantProfile();
        $data['areas'] = ConsultantProfile::getExpertiesOptions(); // return list
        // dd($data);
		return view('consultant.consultant_profile',$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cc_code=Country::all();		
		$data['countries_code'] = $cc_code;
        $model = ConsultantProfile::find($id);
        $data['areas'] = ConsultantProfile::getExpertiesOptions();
        $model->area_expertise = explode(',',$model->area_expertise);
        $data['consultant'] = $model;
        $data['page_title']='Profile edit';

		return view('consultant.consultant_profile_form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $user_id = Auth::user()->id;
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
			'surname' => 'required|max:255',
            'profile_picture' => 'image',  // 'required',
			'password' => 'confirmed|min:6',
            //'email' => 'required|email|max:255|unique:users,email,'.$user_id,
			'date_of_birth' => 'required',
			'qualification' => 'required',
			'industry_expertise' => 'required',
			'country_expertise' => 'required',
            'area_expertise'=>'required',
            'bio' => 'required',
            'languages' => 'required',
            'pin_number' => 'required',
            'link' => 'url',
/*
			'vat_number' => 'required',
			'address' => 'required',
			'bank_details' => 'required',
			'oigp_company' => 'required',
            'bank_iban' => 'required',
            'city' => 'required',*/


        ]);

		//echo '<pre>';print_r($validator->fails());exit;
		if($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }

        $profile_picture_path='';
        $profile_image = $request->file('profile_picture');

		$users['name'] = $request['name'];
		$users['surname'] = $request['surname'];

        if(!empty($request['password'])){
            $users['password'] = bcrypt($request['password']);
        }

		//$users['email'] = $request['email'];

        User::find($user_id)->update($users);


        $profile_data['user_id'] = $user_id;
		$profile_data['gender']=$request['gender'];
		$profile_data['date_of_birth'] = date('Y-m-d',strtotime($request['date_of_birth']));
		$profile_data['qualification'] = $request['qualification'];
		$profile_data['industry_expertise'] = $request['industry_expertise'];
		$profile_data['country_expertise'] =  $request['country_expertise'];
        $expertise = implode(',',$request->get('area_expertise') );
        $profile_data['area_expertise'] =  $expertise;
		$profile_data['languages'] = $request['languages'];
        $profile_data['pin_number'] =  $request['pin_number'];
        $profile_data['experience'] = $request['experience'];
        $profile_data['bio'] = $request['bio'];
        $profile_data['company'] = $request['company'];
        $profile_data['link'] = $request['link'];


        /*$profile_data['bank_iban'] = $request['bank_iban'];
        $profile_data['city'] = $request['city'];
        $profile_data['vat_number'] =  $request['vat_number'];
        $profile_data['address'] =  $request['address'];
        $profile_data['bank_details'] = $request['bank_details'];
        $profile_data['oigp_company'] = $request['oigp_company'];*/

        if(empty($request['allow_personal_data'])){
            $profile_data['allow_personal_data'] = 0;
        }else{
             $profile_data['allow_personal_data'] = $request['allow_personal_data'];
        }

		$user_profile = ConsultantProfile::where('user_id',$user_id)->first();



        if($user_profile != null){
            
            $profile_data['profile_picture'] = Setting::saveUploadedImage($profile_image, $user_profile->profile_picture);
            ConsultantProfile::where('user_id',$user_id)->update($profile_data);

        }else{

            $profile_data['profile_picture'] = Setting::saveUploadedImage($profile_image);
            ConsultantProfile::create($profile_data);
        }




		User::find($user_id)->update(['is_profile_complete'=>1]);

		return redirect('consultant/profile')->with('status', 'Profile Updated!');
    }







    public function updatelogin(Request $request) {
        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $user_id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'password' => 'confirmed|min:6',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $users['name'] = $request['name'];
        $users['surname'] = $request['surname'];

        if(!empty($request['password'])){
            $users['password'] = bcrypt($request['password']);
        }

        //$users['email'] = $request['email'];

        User::find($user_id)->update($users);
        $profile_data['user_id'] = $user_id;
        $user_profile = ConsultantProfile::where('user_id',$user_id)->get();

        if($user_profile->count()>0){
            ConsultantProfile::where('user_id',$user_id)->update($profile_data);
        }else{
            ConsultantProfile::create($profile_data);
        }

        return redirect('consultant/profile')->with('status', 'Profile Saved!');
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

    public function dreamcheck_lab_submission($dreamcheck_id){
        $dream_check_lab =[];
        $dream_check_lab_obj = DreamCheckLab::find($dreamcheck_id);
        $data['page_title']='Dream Check Lab Submission <br/>';

        if(!empty($dream_check_lab_obj)){
            $dream_check_lab = $dream_check_lab_obj->toArray();
            
            if(isset($dream_check_lab_obj->createUser->name) && isset($dream_check_lab_obj->createUser->surname)) {
                $data['page_title'] .= 'from: '. $dream_check_lab_obj->createUser->name.'  '.$dream_check_lab_obj->createUser->surname;
            }
        }

        $data['dream_check_lab'] = $dream_check_lab;

        return view('consultant.dream_check_lab_submission',$data);
    }

    public function dreamcheck_lab_submission_feedback($dreamcheck_id){
        $consultant = Auth::user();
        $consultant_id = $consultant->id;
        $cc_code=Country::all();
        $data['country'] = $cc_code;
        $dream_check_lab = [];
        $dream_check_lab_obj = DreamCheckLab::where('id',$dreamcheck_id)
                                ->where('validate_by',$consultant_id)->first();

        if(!empty($dream_check_lab_obj)){
            $dream_check_lab = $dream_check_lab_obj;
        }

        //echo  '<pre>'; print_r($dream_check_lab); echo '</pre>'; die;
        $data['page_title']='Dream Check Lab Submission Feedback <br/>to: '.$dream_check_lab_obj->createUser->name.'  '.$dream_check_lab_obj->createUser->surname;
        $data['dream_check_lab_feedback'] = $dream_check_lab_obj;

        return view('consultant.dream_check_lab_submission_feedback',$data);
    }








    // !! Validate & submit feedback  !!

    public function dreamcheck_lab_submission_feedback_store(Request $request){
        //echo '<pre>'; print_r($request->all()); die;
        // create achievement three forms validation rule by foreach
        //dd($request->file('upload_cv')->getMimeType()); die;
        $request_achievements=$request->get('achievement');

        foreach($request_achievements as $key => $val) {
                $rules['achievement.'.$key] = 'required';
        }

        // create validation rule of other fields
        $rules['upload_cv'] = 'required|mimes:doc,docx,odt';
        $rules['place'] = 'required';
        $rules['promotion_usp'] = 'required';

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        foreach($request_achievements as $ach_key => $achievement) {
            $dream_check_lab_data['achievement' . $ach_key] = $achievement;
        }

        $interested_country=$request->get('interest_country');

        $dream_check_lab_data['place'] = $request->get('place');
        $dream_check_lab_data['promotion_usp'] = $request->get('promotion_usp');
        $cv_file=$request->file('upload_cv');

        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $file_save_folder_path='/uploads/cv_file/';

        // get cv file
        if(!empty($cv_file)){
            $cv_original_name = $cv_file->getClientOriginalName();

            if(file_exists($base_path.$file_save_folder_path.$cv_original_name)){
                $cv_file_name = time().'-'.$cv_original_name;
                //$outcome_image->getClientOriginalExtension();
            }else {
                $cv_file_name = $cv_original_name;
            }

            $cv_file_name = str_replace(' ', '-', $cv_file_name);
            $cv_file_path = $file_save_folder_path . $cv_file_name;
            $cv_public_path = $base_path.$file_save_folder_path;
            $cv_file->move($cv_public_path,$cv_file_name);
            $dream_check_lab_data['cv_file']=$cv_file_path;
        }

        $user = Auth::user();
        $dream_check_id = $request->get('dream_check_id');
        $dream_check_lab_data['dream_check_lab_id'] = $dream_check_id;

        //Save values in database
        $dreamcheck_lab_obj = DreamCheckLabFeedback::create($dream_check_lab_data);

        if(isset($dreamcheck_lab_obj->id) && !empty($dreamcheck_lab_obj) && $dreamcheck_lab_obj->id > 0) {

            $dream_check_lab = DreamCheckLab::find($dream_check_id);
            
            $dream_check_lab->update(['validate'=>1,'validate_by' => $user->id,'validate_date' => date('Y-m-d H:i:s')]);
            $order = Order::where('user_id',$dream_check_lab->user_id)->where('item_name','Professional Kit')->first();
            if($order != null) {
                if($order->step_id < 4) {
                    $order->update([
                        'step_id' => 4
                    ]);
                }
            }


            // client notification
            $client_obj = User::find($dream_check_lab->user_id); 
            $data['client_id'] = $client_obj->id;
            $data['client_name'] = $client_obj->name;
            $data['dream_check_lab_id'] = $dream_check_lab->id;            
            Mail::send('emails.dream_check_client_notification', ['data'=>$data], function ($m) use ($client_obj) {
                $settings=Setting::find(1);
                $site_email = $settings->website_email;
                $m->from($site_email, 'Wexplore');
                $m->to($client_obj->email, $client_obj->name)->subject('Dream Check Lab Submission!');  // ..TO Client
            });
            
            // send e-mail to admins notification list
            $users['client'] = User::findOrFail($dream_check_lab->user_id);
            $users['consultant'] = User::findOrFail($user->id);
            Mail::send('emails.consultant_feedback_admins_notif', ['user' => $users], function($m) use ($user) {
                $site_email = Setting::find(1)->website_email;
                $admin_emails = User::getNotificationList();
                $m->from($site_email, 'Wexplore');
                $m->to($admin_emails)->subject('A Consultant submitted a feedback to Client');
            });
            

            $base_path = base_path();
            $base_path = str_replace("/wexsite", "", $base_path);
            $pdf_path = '/uploads/dream_'.time().'.pdf';

            $viewdata['dream_check_lab_feedback'] = $dreamcheck_lab_obj;
            $viewdata['page_title'] = 'Dream Check Lab Feedback';
            $viewdata['client'] = $client_obj;

            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('client.dream_check_lab_feedback_pdf', $viewdata);
            $pdf->save($base_path.$pdf_path);
            $dreamcheck_lab_obj->update([
                'feedback_form' => $pdf_path
            ]);

        }



        return redirect()->route('consultant.dashboard')->with('status', 'Your feedback has been submitted successfully and related client is notified for the same.');
    }




    public function download_feedback($id, $type) {

        if($type == ConsultantBooking::TYPE_INTERVIEW) {
            $dream_check_lab = DreamCheckLabFeedback::where('id',$id)->first();

            if($dream_check_lab != null) {
                $data['dream_check_lab'] = $dream_check_lab;
                $data['page_title'] = 'Dream Check Lab Feedback';
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('client.dream_check_lab_feedback_pdf', $data);
                return $pdf->stream();
            }

        }

        if($type == ConsultantBooking::TYPE_QUERY) {
            $query = GlobalToolQuery::where('id',$id)->first();

            if($query != null) {
                $data['query'] = $query;
                $data['noti_mesg'] = '';
                $data['page_title'] = $query->getQuestionTypeOptions($query->question_type_id).' Query ';
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadView('consultant.global_tool_query_feedback_pdf', $data);
                return $pdf->stream();
            }

        }

    }
}
