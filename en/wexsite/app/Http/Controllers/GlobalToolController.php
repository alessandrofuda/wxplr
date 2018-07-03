<?php

namespace App\Http\Controllers;

use App\ConsultantAvailablity;
use App\ConsultantBooking;
use App\ConsultantProfile;
use App\ConsultantServices;
use App\Country;
use App\GlobalToolQuery;
use App\GoToMeeting;
use App\Order;
use App\Service;
use App\Setting;
use App\User;
use App\UserProfile;
use App\UserRoles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Session;


class GlobalToolController extends CustomBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Global Tool Box';
        $order = Order::where('item_name','Global Toolbox')->where('user_id', \Auth::user()->id)->first();

        if($order == null) {
            $service = Service::where('name','Global Toolbox')->first();
            Session::put('payment_service_id',$service->id);
            return redirect('service/payment');
        }

        $old_query = GlobalToolQuery::where('user_id', \Auth::user()->id)->first();

        $query = new GlobalToolQuery();
        $questions = $query->getQuestionTypeOptions();
        $country_list = Country::all();

        if(empty($country_list)){
            $country_list = [];
        }

        $data['country_list'] = $country_list;
        $data['questions'] = $questions;
        $data['user'] = Auth::user();
        $data['query'] = $old_query;

        $data['service'] = Service::where('name','Global Toolbox')->first();

        return view('front.global_toolbox',$data);
    }

    public function query(Request $request) {
        $rules['country'] = 'required';
        $rules['question_type_id'] = 'required';

        if(!Auth::check()) {
            $rules['name'] = 'required|max:255';
            $rules['surname'] ='required|max:255';
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['password'] = 'required|confirmed|min:6';
            $rules['pan'] = 'required';
            //$rules['company'] = 'required';
            $rules['address'] = 'required';
            $rules['country'] = 'required';
            $rules['country_interest'] = 'required';
            $rules['city'] = 'required';
            $rules['zip_code'] = 'required';
            $rules['tos'] = 'required';
        }
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        if(!Auth::check()) {
            $user_data['name'] = $request->get('name');
            $user_data['surname'] = $request->get('surname');
            $user_data['email'] = $request->get('email');
            $password = $request->get('password');
            $user_data['password'] = bcrypt($password);
            $user_profile_data['pan'] = $request->get('pan');
            $user_profile_data['vat'] = $request->get('vat');
            $user_profile_data['address'] = $request->get('address');
            $user_profile_data['country'] = $request->get('country');
            $user_profile_data['company'] = $request->get('company');
            $user_profile_data['city'] = $request->get('city');
            $user_profile_data['telephone'] = $request->get('telephone');
            $user_profile_data['zip_code'] = $request->get('zip_code');
            $tos = $request->get('tos');
            $user_data['tos'] = 0;

            if ($tos == 'on')
                $user_data['tos'] = 1;


            $user = [];

            if (Auth::check()) {
                $user_obj = Auth::user();
            } else {
                $user_obj = User::where('email', $user_data['email'])->first();
            }

            if ($user_obj != null) {
                $user_obj->update($user_data);
                $profile = $user_obj->userProfile;
                $user_profile_data['user_id'] = $user_obj->id;

                if ($profile != null) {
                    $profile->update($user_profile_data);
                } else {
                    $profile_obj = UserProfile::create($user_profile_data);
                }

            } else {
                $user_obj = User::create($user_data);
                $user_profile_data['user_id'] = $user_obj->id;
                $profile_obj = UserProfile::create($user_profile_data);
                $role_arr = array('user_id' => $user_obj->id, 'role_id' => 1);
                $ur = UserRoles::create($role_arr);
            }

            if (!Auth::check()) {
                $credentials = $this->getCredentialsConsultant($request);

                if (Auth::attempt($credentials, $request->has('remember'))) {

                    if (Session::has('login_redirect')) {
                        $redirect_url = Session::get('login_redirect');
                        Session::forget('login_redirect');
                    }

                }

            }
        }
        $query_arr['country'] = $request->get('country');
        $query_arr['question_type_id'] = $request->get('question_type_id');
        $query_arr['comment'] = $request->get('comment');
        $query_arr['user_id'] = Auth::user()->id;
        $query_arr['state_id'] = GlobalToolQuery::STATE_PENDING;
        $query_arr['attach_file'] = Setting::saveUploadedImage($request->file('attach_file'));

        $query_obj = GlobalToolQuery::create($query_arr);

        if($query_obj != null) {
            $consultants = ConsultantProfile::where('area_expertise','like','%'. $request->get('question_type_id').'%')
                ->where('country_expertise', $request->get('country'))->get();
            $ok = false;

            if ($consultants != null) {
                foreach ($consultants as $consultant) {
                    $service = ConsultantServices::where('user_id', $consultant->user_id)
                                                    ->where('service_id', $query_obj->question_type_id)
                                                    ->where('state_id', ConsultantServices::STATE_ACTIVE)->first();

                    if($service != null) {
                        $ok = true;
                        $query_obj->update(['consultant_id' => $consultant->user_id, 'state_id' => GlobalToolQuery::STATE_ASSIGNED]);
                        Mail::send('emails.global_tool_admin_notification', ['query' => $query_obj], function ($m) use ($consultant) {
                            $settings = Setting::find(1);
                            $site_email = $settings->website_email;
                            $m->from(Auth::user()->email, 'Wexplore');
                            $m->to($consultant->user->email, 'Wexplore')->subject('No Country Expert Found.!');
                        });
                        break;
                    }

                }

            }

            if($ok == true) {
                Mail::send('emails.global_tool_admin_notification', ['query' => $query_obj], function ($m) {
                    $settings = Setting::find(1);
                    $site_email = $settings->website_email;
                    $m->from($site_email, 'Wexplore');
                    $m->to($site_email, 'Wexplore')->subject('No Country Expert Found.!');
                });
            }

        }

        return redirect('user/global/dashboard');
    }

    public function dashboard() {
        $data['page_title'] = 'Your Queries';
        $queries = GlobalToolQuery::where('user_id',Auth::user()->id)->get();
        $queries_all = [];

        foreach($queries as $query) {
            if($query->getBookingStatus() == 'NOK' || $query->getBookingStatus() == 'Cancelled')
                $queries_all[] = $query;
        }

        $data['queries'] = $queries_all;

        if(count($queries)  == 0) {
            return redirect('global_toolbox');
        }

        return view('client.global_dashboard',$data);
    }

    public function query_view($id) {
        $data['page_title'] = 'Country Experts';
        $query = GlobalToolQuery::where('id',$id)->first();

        if($query->state_id != GlobalToolQuery::STATE_PENDING) {
            $consultant_avail = ConsultantAvailablity::where('consultant_id',$query->consultant_id)
                ->where('type_id',$query->question_type_id)
                ->where('available_date','>=',strtotime('today'))
                ->where('status',1)->where('is_booked',ConsultantAvailablity::STATUS_PENDING)->get();
        }

        $data['consultant_avail'] = $consultant_avail;
        $data['query'] = $query;

        return view('client.consultant_availability_calender',$data);
    }

    public function consultant_booking(Request $request,$id){
        $user = Auth::user();
        $user_id = $user->id;
        $availablity_id = $request['availablity_id'];
        $query_id = $id;
        $query_obj = GlobalToolQuery::where('id',$query_id)->first();
        $check_if_already_book = ConsultantBooking::where(['availablity_id'=>$availablity_id])
            ->where('status', '!=', ConsultantBooking::STATE_CANCELLED)->first();

        if($check_if_already_book != null){
             $ConsultantBooking = ConsultantBooking::where([
                'type_id' => ConsultantBooking::TYPE_QUERY,
                'availablity_id'=>$availablity_id,
                 'user_id'=>$user_id,'query_id'=>$query_id])->first();
        }else{
            $ConsultantBooking = ConsultantBooking::create([
                'type_id' => ConsultantBooking::TYPE_QUERY,
                'status' => ConsultantBooking::STATE_PENDING,
                'user_id'=>$user_id,'availablity_id'=>$availablity_id,'query_id'=>$query_id]);
        }

        if($query_obj->update([
            'state_id' => GlobalToolQuery::STATE_BOOKED
        ])) {
            //print_r($ConsultantBooking);exit;
            /* Email to user */
            Mail::send('emails.consultant_booking', ['user' => $user, 'consultantbooking' => $ConsultantBooking], function ($m) use ($user) {
                $settings = Setting::find(1);
                $site_email = $settings->website_email;
                $m->from($site_email, 'Wexplore');
                $m->to($user->email, $user->name)->subject('Consultant Booking!');
            });
            /* Email to consultant */
            Mail::send('emails.user_booked_consultant', ['consultantbooking' => $ConsultantBooking], function ($m) use ($ConsultantBooking) {
                $settings = Setting::find(1);
                $site_email = $settings->website_email;
                $to = $ConsultantBooking->availablity->consultant->email;
                $name = $ConsultantBooking->availablity->consultant->name;
                $m->from($site_email, 'Wexplore');
                $m->to($to, $name)->subject('New Consultant Booking!');
            });

            /* Email to super admin */
            Mail::send('emails.admin_consultant_booking', ['consultantbooking' => $ConsultantBooking], function ($m) use ($ConsultantBooking) {
                $settings = Setting::find(1);
                $site_email = $settings->website_email;
                $m->from($site_email, 'Wexplore');
                $m->to($site_email, 'Wexplore')->subject('New Consultant Booking!');
            });

            // Save gotomeeting
            $meeting = GoToMeeting::where('booking_id', $ConsultantBooking->id)->first();

            if($meeting == null)
                $data = $ConsultantBooking->saveMeeting(GoToMeeting::TYPE_MEETING);
		
            $ConsultantBooking->availablity->update(
                ['is_booked' => ConsultantAvailablity::STATUS_BOOKED]
            );

        }

        return redirect('/user/myappointments')->with('status','Thank you! Your session is now booked! Do not forget to log back in your dashboard to connect with your consultant!');

    }

    public function appointments() {
        $data['page_title'] = 'My Appointments';
        $appointments = ConsultantBooking::where('user_id',Auth::user()->id)->get();
        $data['appointments'] = $appointments;

        return view('client.appointments',$data);
    }

    public function cancel_appointment($id) {
        $booking = ConsultantBooking::find($id);
        $booking->update(
            ['status' => ConsultantBooking::STATE_CANCELLED]
        );
        $booking->cancelMeeting();

        $booking->availablity->update(
            ['is_booked' => 0]);

        $data['consultantbooking'] = $booking;
        $data['user'] = $booking->availablity->consultant;
        $to_email = $booking->availablity->consultant->email;

        Mail::send('emails.consultant_booking_cancel', ['data'=>$data, 'user'=>$booking->availablity->consultant,
            'consultantbooking' => $booking], function ($m) use ($to_email) {
            $settings=Setting::find(1);
            $site_email = $settings->website_email;
            $m->from($site_email, 'Wexplore');
            $m->to($to_email, 'Wexplore')->subject('Booking Cancelled!');
        });

        if($booking->type_id == ConsultantBooking::TYPE_QUERY) {
            $query = GlobalToolQuery::find($booking->query_id);
            $query->update(
                ['state_id' => GlobalToolQuery::STATE_ASSIGNED]
            );

            return redirect()->back()->with('success', 'Successfully Cancelled');
            //return redirect('user/global/'.$booking->query_id.'/book')->with('success', 'Successfully Cancelled');
        }
        return redirect()->back()->with('success', 'Successfully Cancelled');
      //  return redirect('user/role_play_interview')->with('success', 'Successfully Cancelled');
    }







// Citrix API HTTP Status Codes --> per implementare pulsante richiama
// https://goto-developer.logmeininc.com/citrix-api-http-status-codes







    public function start_meeting($id) {
        $data['page_title'] = 'Session';
        $appointment = ConsultantBooking::find($id); 

        /*if(!$appointment->checkDate()) {
            return redirect('consultant/dashboard')->with('error', 'Meeting is expired.');
        }*/

        $data['appointment'] = $appointment;
        $start_meeting_url = $appointment->start_meeting(); 

        if(isset($start_meeting_url) && $start_meeting_url != '') {
            // dd($response['hostURL']); 
            return  redirect()->away($start_meeting_url);   // !! GO AWAY TO REMOTE CALL TO ZOOM SERVERS !!
        }

        Log::info('Error: $start_meeting_url NOT setted or empty!');

        $data['hostUrl'] = $start_meeting_url;  // $response['hostURL'];
        $data['noti_mesg'] = '';

        return view('consultant.session',$data);
    }

    public function upload_recording(Request $request, $id)
    {
        $file = $request->file('upload_file');
        // init var
        $result = [ 'status' => 'NOK'];

        $recording_file = Setting::saveUploadedImage($request->file('upload_file'));

        if($recording_file != null) {
            $booking = ConsultantBooking::find($id);

            if($booking->update([
                'recording' => $recording_file,
                'state_id' => ConsultantBooking::STATE_COMPLETED
            ])) {
                $result['status'] = 'OK';
            }

        };

        return $result;
    }

    public function updateOrdersTab(Request $request){

            $user_id = ConsultantBooking::find($request->app_id)->user_id; 
            $call_numbers = ConsultantBooking::where('user_id', $user_id)
                                            ->where('type_id', ConsultantBooking::TYPE_INTERVIEW)  
                                            ->where('state_id', '!=', ConsultantBooking::STATE_CANCELLED)
                                            ->get();

            // importante: update db SOLO se è la SECONDA CALL ...
            if(count($call_numbers) > 1) {

                $step5 = Order::where('user_id', $user_id)
                              ->where('item_id', 2)
                              ->update(['step_id' => 5]);

                return 'Ok: ' . $step5 . ' record updated in db (Orders.step_id=5). '.count($call_numbers). 'call prenotate.';

            }
            
            return 'Calls Number: '. count($call_numbers);  // return to success() Ajax function ..
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

    protected function getCredentialsConsultant(Request $request)
    {
        return $request->only('email', 'password');
    }
}
