<?php

namespace App\Http\Controllers;

use App\ConsultantAvailablity;
use App\ConsultantBooking;
use App\CultureMatchSurvey;
use App\Setting;
use App\SurveyCode;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use App\Country;
use App\UserRoles;
use App\UserProfile;
use App\User;
use App\GlobalTestResult;
use Mail;


class UserProfileController extends CustomBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $data['page_title']='Personal Area';
        $cc_code=Country::all();
        $data['countries_code'] = $cc_code;
        $data['user'] = Auth::user();
        $data['active_from_date'] = explode(' ', $data['user']->created_at)[0];
        $data['active_from_time'] = explode(' ', $data['user']->created_at)[1];

		return view('client.user_profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        
        $cc_code=Country::all();		
		$data['countries_code'] = $cc_code;
        $data['page_title']='Profile edit';
        $data['occupations'] = User::getOccupationsList();
        $data['user'] = Auth::user();
		return view('client.user_profile_form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request) {
        $base_path=base_path();
        $base_path=str_replace("/wexsite", "", $base_path);
        $user_id = Auth::user()->id;
        $redirect_url = $request->get('redirect_url');
        if($redirect_url != 'market_analysis') {
            $rules['name'] = 'required|max:255';
            $rules['surname'] = 'required|max:255';
            // $rules['password'] = 'confirmed|min:6';
        }
        //'email' => 'required|email|max:255|unique:users,email,'.$user_id,  
        $rules['profile_picture'] = 'image'; 
        $rules['gender'] = 'required';
        $rules['age_range'] = 'required';
        $rules['country_origin'] = 'required';
        $rules['country_interest'] = 'required';
        $rules['education'] = 'required';
        $rules['industry'] = 'required';
        $rules['occupation'] = 'required';
        $rules['occupational_status'] = 'required';
        $rules['salary_range'] = 'required';

        if($request->get('redirect_url') != 'market_analysis') {
            $rules['pan'] = 'required';
            $rules['country'] = 'required';
            $rules['city'] = 'required';
            $rules['zip_code'] = 'required';
            $rules['address'] = 'required';
        }

		$validator = Validator::make($request->all(), $rules);
		//echo '<pre>';print_r($validator->fails());exit;
		if($validator->fails()) {
        	return back()->withErrors($validator->errors());
        }
        $profile_picture_path='';


        if($redirect_url != 'market_analysis') {
            $users['name'] = $request['name'];
            $users['surname'] = $request['surname'];
            // if (!empty($request['password'])) {
            //     $users['password'] = bcrypt($request['password']);
            // }
        }

        $profile_data['user_id'] = $user_id;
		$profile_data['gender']=$request['gender'];
		$profile_data['age_range'] = $request['age_range'];
		$profile_data['country_origin'] = $request['country_origin'];
		$profile_data['country_interest'] = $request['country_interest'];
		$profile_data['education'] =  $request['education'];
		$profile_data['industry'] = $request['industry'];
		$profile_data['occupation'] =  $request['occupation'];
		$profile_data['occupational_status'] =  $request['occupational_status'];
		$profile_data['salary_range'] = $request['salary_range'];

        if($request->get('redirect_url') != 'market_analysis') {
            $profile_data['pan'] = $request->get('pan');
            $profile_data['vat'] = $request->get('vat');
            $profile_data['country'] = $request->get('country');
            $profile_data['city'] = $request->get('city');
            $profile_data['telephone'] = $request->get('telephone');
            $profile_data['zip_code'] = $request->get('zip_code');
            $profile_data['address'] = $request->get('address');
            $profile_data['company'] = $request->get('company');
        }

        if(empty($request['allow_personal_data'])){
            $profile_data['allow_personal_data'] = 0;
        }
        else{
             $profile_data['allow_personal_data'] = $request['allow_personal_data'];
        }

		$user_profile = UserProfile::where('user_id',$user_id)->first();
        $profile_image = $request->file('profile_picture');
        $profile_data['profile_picture'] = Setting::saveUploadedImage($profile_image,$user_profile->profile_picture);
        if($user_profile->exists == 1){
            $user_profile->update($profile_data);
        }
        else{
            UserProfile::create($profile_data);
        }
        $user_profile->update(['is_profile_complete'=>1]);
    
        if($redirect_url == 'market_analysis'){
            $status_message = 'Thank you for filling this Profile Form! Please proceed to the Market Analysis output.';

            $label = 'student';

            if($user_profile->occupational_status != 'Student') {
                $label = 'pro';
            }

            $survey_code = SurveyCode::where('is_assigned',0)
            ->where('label', $label)->first();

            if($survey_code != null) {
                $culture_match['user_id'] = $user_profile->user_id;
                $culture_match['survey_code'] = $survey_code->survey_code;
                $culture_match_obj = CultureMatchSurvey::create($culture_match);

                $survey_code->update(['is_assigned' => 1]);
            }

        }else {
            $status_message = 'Profile Updated!';
        }



		return redirect()->route($redirect_url)->with('status', $status_message);
    }


    public function updateLogin(Request $request)
    {
        $user_id = Auth::user()->id;
        $rules['name'] = 'required|max:255';
        $rules['surname'] = 'required|max:255';
        $rules['password'] = 'confirmed|min:6';
        $validator = Validator::make($request->all(), $rules);
        //echo '<pre>';print_r($validator->fails());exit;
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $users['name'] = $request['name'];
        $users['surname'] = $request['surname'];
        if (!empty($request['password'])) {
            $users['password'] = bcrypt($request['password']);
        }
        $status_message = 'Profile Updated!';
        return redirect()->route('user_profile')->with('status', $status_message);
    }


    public function updatePersonal(Request $request)
    {
        $base_path=base_path();
        $user_id = Auth::user()->id;
        $rules['pan'] = 'required';
        $rules['country'] = 'required';
        $rules['city'] = 'required';
        $rules['zip_code'] = 'required';
        $rules['address'] = 'required';


        $validator = Validator::make($request->all(), $rules);
        //echo '<pre>';print_r($validator->fails());exit;
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $profile_picture_path='';

        $user_profile_data['pan'] = $request->get('pan');
        $user_profile_data['vat'] = $request->get('vat');
        $user_profile_data['country'] = $request->get('country');
        $user_profile_data['city'] = $request->get('city');
        $user_profile_data['telephone'] = $request->get('telephone');
        $user_profile_data['zip_code'] = $request->get('zip_code');
        $user_profile_data['address'] = $request->get('address');
        $user_profile_data['company'] = $request->get('company');


        $user_profile = UserProfile::where('user_id',$user_id)->first();
        if($user_profile->exists == 1){
            $user_profile->update($user_profile_data);
        }
        else{
            UserProfile::create($user_profile_data);
        }
        $user_profile->update(['is_profile_complete'=>1]);
        return redirect()->route('user_profile')->with('status', 'Successfully updated');
    }



    public function deletePersonal() { 
        
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->delete();
        
        $user_role = UserRoles::where('user_id',$user_id);  
        if(isset($user_role) && !empty($user_role)){
            $user_role->delete();
        }

        $user_profile = UserProfile::where('user_id',$user_id);
        if(isset($user_profile) && !empty($user_profile)){
            $user_profile->delete();
        }

        $user_global_test_result = GlobalTestResult::where('user_id',$user_id);
        if(isset($user_global_test_result) && !empty($user_global_test_result)) {
            $user_global_test_result->delete();
        }

        //$user_dream_check_lab = DreamCheckLab::where('user_id',$user_id);
        //if(isset($user_dream_check_lab) && !empty($user_dream_check_lab)) {
        //    $user_dream_check_lab->delete();
        //}
        

        // mail admin notification
        Mail::send('emails.alerts.user_auto_deleted', ['user' => $user], function($m) {
            $site_email = Setting::find(1)->website_email;
            $admin_emails = User::getNotificationList();
            $m->from($site_email, 'Wexplore');
            $m->to($admin_emails)->subject('A user has auto-deleted his account from Wexplore.');
        });


        return redirect('/')->with('status', 'User deleted!');

    }




    public function deletePersonalFromEmailLink($user_id) {

        $client_profile_page = route('user_profile');
        $user_roles_obj = UserRoles::where('user_id', $user_id)->first();
        
        if( $user_roles_obj !== null && $user_roles_obj->role_id == 1) {  // only if he has Client role
            // auto-login
            Auth::loginUsingId($user_id);
        }

        return redirect($client_profile_page.'#account');

    }




    public function mydocuments($id = null) {

        if($id == null)
            $id = \Auth::user()->id;

        $user = User::find($id);

        $data['page_title'] = 'My Documents';
        $data['documents'] = $user->getDocuments();

        //dd($data['documents'][0]['date']);

        return view('front.my_documents', $data);


    }
}
