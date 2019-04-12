<?php

namespace App\Http\Controllers\Auth;
use App\Service;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Form;use Mail;
use Illuminate\Http\Request;use App\Setting;
use App\UserRoles;use Carbon;use App\UserProfile;
use Route;
use Session;
use App\Country;
use App\ConsultantProfile;
use App\Http\Controllers\CustomBaseController;

class AuthController extends CustomBaseController
{
    /*
    |--------------------------------------------------------------------------
    | registeration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registeration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;  // AuthenticatesAndRegistersUsers


	//protected $redirectPath = '/user/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();
        $this->middleware('customquest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registeration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
			'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed|min:6',
        ]);
    }
	public function getConsultantRegister(){
		$cc_code=Country::all();
		$data['countries_code'] = $cc_code;
		$model = new UserProfile();
		$data['areas'] = UserProfile::getExpertiesOptions();
        return view('auth.consultant_register',$data);
	}
	public function postConsultantRegister(Request $request){
		$users = array();$role_arr = array();
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
			'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|confirmed|min:6',
			'date_of_birth' => 'required',
			'qualification' => 'required',
			'industry_expertise' => 'required',
			'experience' => 'required|integer|max:50|min:1',
			'country_expertise' => 'required',
			'area_expertise' => 'required',
			'bio' => 'required',
			'languages' => 'required',
			'policy' => 'required'
/*
			'pin_number' => 'required',
			'vat_number' => 'required',
			'address' => 'required',
			'bank_details' => 'required',
			'oigp_company' => 'required',
			'city' => 'required',
			'bank_iban' => 'required'*/

        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors())->withInput();
        }

		$name = $request['name'];
		$surname  = $request['surname'];
		$email = $request['email'];
		$password = $request['password'];
		$date_of_birth = date('Y-m-d',strtotime($request['date_of_birth']));
		$qualification = $request['qualification'];
		$industry_expertise = $request['industry_expertise'];
		$country_expertise = $request['country_expertise'];
		$languages = $request['languages'];
		$experience = $request['experience'];

		/*	
		$vat_number = $request['vat_number'];
		$address = $request['address'];
		$bank_details = $request['bank_details'];
		$oigp_company = $request['oigp_company'];*/

		$allow_personal_data = $request['allow_personal_data'];

		$users['name'] = $name;
		$users['surname'] = $surname;
		$users['email'] = $email;
		$users['password'] = bcrypt($password);
		if(isset($allow_personal_data)){
			$consult_profile_data['allow_personal_data'] = $allow_personal_data;
		}else{
			$consult_profile_data['allow_personal_data'] = 0;
		}

		$consult_profile_data['date_of_birth'] = $date_of_birth;
		$consult_profile_data['qualification'] = $qualification;
		$consult_profile_data['industry_expertise'] = $industry_expertise;
		$consult_profile_data['country_expertise'] = $country_expertise;
		$consult_profile_data['languages'] = $languages;
		/*	
		$consult_profile_data['vat_number'] = $vat_number;
		$consult_profile_data['address'] = $address;
		$consult_profile_data['bank_details'] = $bank_details;
		$consult_profile_data['oigp_company'] = $oigp_company;
		$consult_profile_data['bank_iban'] = $request['bank_iban'];
		$consult_profile_data['city'] = $request['city'];*/

		$expertise = implode(',',$request->get('area_expertise') );
		$consult_profile_data['area_expertise'] =  $expertise;
		$consult_profile_data['experience'] = $experience;
		// $consult_profile_data['pin_number'] = $request['pin_number'];
		$consult_profile_data['bio'] = $request['bio'];
		// $consult_profile_data['company'] = $request['company'];

		$user_obj = User::create($users);
		$consult_profile_data['user_id'] = $user_obj->id;
		$profile_image = $request->file('profile_picture');

		$consult_profile_data['profile_picture'] = Setting::saveUploadedImage($profile_image);

		$cp = ConsultantProfile::create($consult_profile_data);

		$role_arr = array('user_id'=>$user_obj->id,'role_id'=>2);
		$ur = UserRoles::create($role_arr);
		$credentials = $this->getCredentialsConsultant($request);
		$data['user'] = $user_obj;
		$to_email = $user_obj->email;
		Mail::send('emails.registeration', ['user' => $user_obj,'password'=>$password], function ($m) use ($user_obj) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$m->from($site_email, 'Wexplore');

			$m->to($user_obj->email, $user_obj->name)->subject('You are registered successfuly!');
		});

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('consultant/dashboard');
        }
		//echo '<pre>';print_r($request['name']);exit;
		//return redirect('consultant/dashboard');
	}
	protected function getCredentialsConsultant(Request $request)
    {
        return $request->only('email', 'password');
    }
    /**
     * Create a new user instance after a valid registeration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {

		$users['name'] = $data['name'];
		$users['surname'] = $data['surname'];
		$users['email'] = $data['email'];
		$users['password'] = bcrypt($data['password']);
		if(isset($data['allow_personal_data'])){
			$profile_data['allow_personal_data'] = $data['allow_personal_data'];
		}else{
			$profile_data['allow_personal_data'] = 0;
		}
		$user_type = $data['type'];

		if (Session::has('user_type')) {
			Session::forget('user_type');
			Session::put('user_type', $user_type);
		}else{
			Session::put('user_type', $user_type);
		}
		$user_obj = User::create($users);
		$profile_data['user_id']=$user_obj->id;
		UserProfile::create($profile_data);
		$user = User::findOrFail($user_obj->id);

		$role_arr = array('user_id'=>$user->id,'role_id'=>1);  // User role !!
		$ur = UserRoles::create($role_arr);

        // user notification
        Mail::send('emails.registeration', ['user' => $user,'password'=>$data['password']], function ($m) use ($user) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
            $m->from($site_email, 'Wexplore');
            $m->to($user->email, $user->name)->subject('You are registered successfuly!');
        });

        // admin notification
        Mail::send('emails.registeration_admin_notif', ['user' => $user], function($m) use ($user) {
			$site_email = Setting::find(1)->website_email;			
			$admin_emails = User::getNotificationList();
            $m->from($site_email, 'Wexplore');
            $m->to($admin_emails)->subject('New account at Wexplore has been activated');
        });

		/*$service_name = 'Global Orientation Test';


		Mail::send('emails.service_activation', ['user' => $user_obj,'service_name'=>$service_name,'password'=>$password], function ($m) use ($user_obj) {
			$settings=Setting::find(1);
			$site_email = $settings->website_email;
			$m->from($site_email, 'Wexplore');

			$m->to($user_obj->email, $user_obj->name)->subject('You are registered successfuly!');
		});*/

        return $user_obj;
    }
	/**
     * overrride redirect after login based on user role.
     *
     * @param  array  $request, $user
     */
	protected function authenticated($request, $user) {
		/*if (Session::has('user_type')) {
			$user_type = Session::get('user_type');
		}else{
			$user_type = 'basic';
		}*/
		// if session set redirect to parent url from where user comes on login form
		if(Session::has('login_redirect')){
			$redirect_url = Session::get('login_redirect');
			Session::forget('login_redirect');
			return redirect()->away($redirect_url);
		}

		$roles_arr = array();
		foreach($request->user()->userRoles as $roles){
            $roles_arr[] = $roles->role_id;
        }
        
        if($user->is_admin == 1) {
            return redirect()->intended('/admin/dashboard');
        }elseif(in_array(1,$roles_arr)){
			return redirect()->intended('/user/dashboard');
		}elseif(in_array(2,$roles_arr)){
			return redirect()->intended('/consultant/dashboard');
		}
    }

    public function postLogin(Request $request) {
		
		$this->validate($request, [
			'email' => 'required|email', 
			'password' => 'required',
		]);
		$credentials = $request->only('email', 'password');
		
		if (Auth::attempt($credentials, $request->has('remember'))) {

			return $this->authenticated($request, Auth::user()); //redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath()) 
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	public function loginPath() {
		return property_exists($this, 'loginPath') ? $this->loginPath : '/login';
	}

	protected function getFailedLoginMessage() {
		return 'Login incorrect, please retry.';
	}

	public function postRegister(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
        	return back()->withInput()->withErrors($validator->errors());
        }
        Auth::login($this->create($request->all()));
		// if session set redirect to parent url from where user comes on registeration form
		if(Session::has('login_redirect')){
			$redirect_url=Session::get('login_redirect');
			Session::forget('login_redirect');
			return redirect()->away($redirect_url);
		}
		return redirect('/user/dashboard');
        //return redirect($this->redirectPath());
    }
	/**
     * Create a new form for website users/customers.
     *
     * @param  array  $data
     * @return view
     */
	public function login(){
		
		return view('front.login');
	}

	/* create client register form */
	public function getClientRegister() {
		$country_list = Country::all();
		if(empty($country_list)){
			$country_list = [];
		}
		$data['country_list'] = $country_list;
		$data['page_title'] = 'Client Register';
		return view('auth.client_register',$data);
	}
	public function postclientregister(Request $request) {
		$rules['name'] = 'required|max:255';
		$rules['surname'] ='required|max:255';
		$rules['email'] = 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL';
		$rules['password'] = 'required|confirmed|min:6';
		$rules['pan'] = 'required';
		$rules['address'] = 'required';
		$rules['country'] = 'required';
		$rules['city'] = 'required';
		$rules['zip_code'] = 'required';

		if($request->get('company') != '') {
			$rules['vat'] = 'required';
		}

		$validator = Validator::make($request->all(),$rules);

		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		}

		$user_data['name'] = $request->get('name');
		$user_data['surname'] =  $request->get('surname');
		$user_data['email'] =  $request->get('email');
		$password = $request->get('password');
		$user_data['password'] =  bcrypt($password);
		$user_profile_data['pan'] = $request->get('pan');
		$user_profile_data['vat'] = $request->get('vat');
		$user_profile_data['address'] = $request->get('address');
		$user_profile_data['company'] = $request->get('company');
		$user_profile_data['country'] = $request->get('country');
		$user_profile_data['city'] = $request->get('city');
		$user_profile_data['telephone'] = $request->get('telephone');
		$user_profile_data['zip_code'] = $request->get('zip_code');

		$user_obj = User::create($user_data);
		if(isset($user_obj->id)){
			$user_profile_obj = UserProfile::create($user_profile_data);
			if(isset($user_profile_obj->id)){
				$user_profile_obj->update([
					'user_id'=>$user_obj->id
				]);
				$role_arr = array('user_id'=>$user_obj->id,'role_id'=>1);
				$ur = UserRoles::create($role_arr);
				$credentials = $this->getCredentialsConsultant($request);
				$data['user'] = $user_obj;
				$to_email = $user_obj->email;

				Mail::send('emails.registeration', ['user' => $user_obj,'password'=>$password], function ($m) use ($user_obj) {
					$settings=Setting::find(1);
					$site_email = $settings->website_email;
					$m->from($site_email, 'Wexplore');

					$m->to($user_obj->email, $user_obj->name)->subject('You are registered successfuly!');
				});
				/*$service_name = 'Global Orientation Test';
				Mail::send('emails.service_activation', ['user' => $user_obj,'service_name'=>$service_name,'password'=>$password], function ($m) use ($user_obj) {
					$settings=Setting::find(1);
					$site_email = $settings->website_email;
					$m->from($site_email, 'Wexplore');

					$m->to($user_obj->email, $user_obj->name)->subject('You are registered successfuly!');
				});*/
				if (Auth::attempt($credentials, $request->has('remember'))) {
					/*if(Session::has('login_redirect')){
						$redirect_url=Session::get('login_redirect');
						Session::forget('login_redirect');
						return redirect($redirect_url);
					}*/
					return redirect()->intended('user/dashboard');
				}else{
					return redirect()->intended('login');
				}
			}else{
				$user_obj->delete();
				return redirect()->back()->with('status', 'Something went wrong.. PLease try agian..')->withInput();
			}
		}
		return redirect()->back()->with('status', 'Something went wrong.. PLease try agian..')->withInput();
	}


	public function getLogout(){
		Auth::logout();
		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	public function getRegister() {
		return view('auth.register');
	}

}
