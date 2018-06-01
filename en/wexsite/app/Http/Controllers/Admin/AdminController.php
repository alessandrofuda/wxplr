<?php

namespace App\Http\Controllers\Admin;

use App\ConsultantBooking;
use App\ConsultantServices;
use App\Country;
use App\DreamCheckLab;
use App\GlobalToolQuery;
use App\GoToMeeting;
use App\Order;
use App\OrderTransaction;
use App\Role;
use App\User;
use App\UserRoles;
use App\Page;
use App\Navigation;
use App\Question;
use App\Choice;
use App\Setting;
use App\UserProfile;
use App\ConsultantProfile;
use App\DreamCheckLabFeedback;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;
use Validator;
use Hash;

class AdminController extends Controller
{
    public function index(){
		$countries = Country::all();
		$weekOrders = [];
		$monthOrders = [];
		$current_week = ltrim(date('W'), '0');
		$current_month = ltrim(date('m'),'0');

		foreach ($countries as $country) {
			$dream_check_lab = DreamCheckLab::where(\DB::raw('Week(dream_check_lab.created_at)'),'=', $current_week)->where('interest_country', $country->country_name)->count();
			if($dream_check_lab > 0)
				$weekOrders[$country->country_name]['professional_kit'] = $dream_check_lab;
			$gloabl_tool_query = GlobalToolQuery::where(\DB::raw('Week(global_tool_query.created_at)'),'=', $current_week)->where('country', $country->country_name)->count();
			if($gloabl_tool_query > 0)
				$weekOrders[$country->country_name]['global_tool_query'] = $gloabl_tool_query;
			$dream_check_lab_month = DreamCheckLab::where(\DB::raw('Month(dream_check_lab.created_at)'),'=', $current_month)->where('interest_country', $country->country_name)->count();
			if($dream_check_lab_month > 0)
				$monthOrders[$country->country_name]['professional_kit'] = $dream_check_lab_month;
			$gloabl_tool_query_month = GlobalToolQuery::where(\DB::raw('Month(global_tool_query.created_at)'),'=', $current_month)->where('country', $country->country_name)->count();
			if($gloabl_tool_query_month > 0)
				$monthOrders[$country->country_name]['global_tool_query'] = $gloabl_tool_query_month;
		}

		$data['weekOrders'] = $weekOrders;
		$data['monthOrders'] = $monthOrders;



		/*
		// testing 
		// $data['lastClients'] = UserRoles::where('role_id', '1')->orderBy('created_at','DESC')->limit('10')->get();
		$data['lastClients'] = User::whereHas('roles', function($q) {
			$q->where('role_id', '1');
		})
			->orderBy('created_at','DESC')
			->limit('10')
			->get();

		// dd($data['lastClients']);

		$data['lastConsultants'] = User::whereHas('roles', function($q) {
			$q->where('role_id', '2');
		})
			->orderBy('created_at','DESC')
			->limit('10')
			->get();
		// dd($data['lastConsultants']);
		*/




        return view('admin.dashboard', $data);
    }   

	public function dream_pdf($id) {
	 $dreamcheck_lab_obj = DreamCheckLabFeedback::find($id);
	 $viewdata['dream_check_lab_feedback'] = $dreamcheck_lab_obj;
				$viewdata['page_title'] = 'Dream Check Lab Feedback';
				 $pdf = \App::make('dompdf.wrapper');
					$pdf->loadView('client.invoice_pdf', $viewdata);
					return $pdf->stream();
				return view('client.invoice_pdf', $viewdata);
	}
	 /**
     * Create a new controller instance for users.
     *
     * @return view
     */ 
    public function create_role(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    	//$validator = $this->validate($request, [
            'role_name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }
        $role_name=$request['role_name'];
        $role_id=$request['role_id'];
        $form_type=$request['form_type'];
        if($form_type=='create'){
            Role::create([
                'role_name' => $request['role_name'],
            ]);
        }
        elseif($form_type=='edit'){
            $role = Role::find($role_id);
            $role->role_name = $role_name;
            $role->save();
        }
        return redirect('admin/roles');
    }
    /**
     * Create a new controller instance for roles.
     *
     * @return view
     */
    public function roles()
    {
    	//$roles=Role::paginate(2);
        $roles=Role::all();
    	$data['page_title']='Roles';
    	$data['roles']=$roles;
        return view('admin.roles',$data);
    }
    /**
     * edit roles.
     *
     * @return view
     */
    public function role_edit($role_id)
    {
        $role=Role::find($role_id);
        //echo '<pre>'; print_r($role); exit;
    	$data['page_title']='Role edit';
        $data['role']=$role;
        return view('admin.role_edit',$data);
    }
    /**
     * delete roles.
     *
     * @return view
     */
    public function role_delete($role_id)
    {
    	$data['page_title']='Role delete';
        $role = Role::find($role_id);
        $role->delete();
        return redirect('admin/roles');
    }

    /**
     * Create a new controller instance for users.
     *
     * @return view
     */ 
    public function users(Request $request)
    {
		$end_date = date('Y-m-d');
		$start_date = '0000-00-00';

		if($request->get('start_date') != '') {
			$start_date = $request->get('start_date');
			$data['start_date'] = $start_date;
		}

		if($request->get('end_date') != '') {
			$end_date = $request->get('end_date');
			$data['end_date'] = $end_date;
		}
        $users = User::select('users.*')->join('user_roles','user_roles.user_id','=','users.id')
			 			->whereBetween(\DB::raw('DATE(users.created_at)'), [$start_date, $end_date])
						->where('user_roles.role_id', 1)
						->where('user_roles.deleted_at','=', NULL)
						->get();

    	$data['page_title']='Users';
        $data['users'] = $users;
        
        return view('admin.users',$data);
    }


	/**
     * add new users form.
     *
     * @return view
     */
    public function user_add()
    {
		// get all role list
		$roles=Role::all();
		// store data for view
		$data['page_title']='Add new user';
		$data['roles']=$roles;
		return view('admin.user_add',$data);
	}
	/**
     * add new users form.
     *
     * @return view
     */
    public function user_create(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
			'lastname' => 'max:255',
			'email' => 'email|required|max:255',
			'password' => 'confirmed|max:255',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }
		$user_id=trim($request['user_id']);
		$user_name=trim($request['name']);
		$user_lastname=trim($request['lastname']);
        $user_email=trim($request['email']);
		$user_pwd=trim($request['password']);
		$user_roles=$request['user_roles'];
		$is_admin= trim($request['isadmin']); 
		$form_type=trim($request['form_type']);
		if($form_type=='create'){
			$users_create['name']=$user_name;
			$users_create['surname']=$user_lastname;
			$users_create['email']=$user_email;
			$users_create['is_admin']=$is_admin;
			if(!empty($user_pwd)) {
				$users_create['password']=Hash::make($user_pwd);
			}
            // create user
			$user=User::create($users_create);
			$user_id=$user->id;
			// Add roles to user
			$user_roles_data=array();
			foreach($user_roles as $user_role){
				if($user_role != '_none' ) {
					$user_roles_data[]=array('user_id'=>$user_id, 'role_id'=>$user_role, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
				}
			}
			if(!empty($user_roles_data)){
				UserRoles::insert($user_roles_data);
			}
        }
        elseif($form_type=='edit'){
            // Update user
			$user = User::find($user_id);
			$user->name = $user_name;
			$user->surname = $user_lastname;
			$user->email = $user_email;
			$user->is_admin=$is_admin;
			if(!empty($user_pwd)) {
				$user->password = Hash::make($user_pwd);
			}
			$user->save();
			// delete all roles of this user
			$role = UserRoles::where('user_id','=',$user_id);
			$role->delete();
			// Add roles to user
			$user_roles_data=array();
			foreach($user_roles as $user_role){
				if($user_role != '_none' ) {
					$user_roles_data[]=array('user_id'=>$user_id, 'role_id'=>$user_role, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s'));
				}
			}
			if(!empty($user_roles_data)){
				UserRoles::insert($user_roles_data);
			}
        }
		
        return redirect('admin/users');
	}
    /**
     * edit page users.
     *
     * @return view
     */
    public function user_edit($user_id)
    {
		// get all role list
		$roles=Role::all();
		$user=User::find($user_id);
		// get user assigned roles
		$user_roles = User::find($user_id)->userRoles;
		$assigned_roles=array();
		foreach ($user_roles as $user_role) {
			$assigned_roles[]=$user_role->role_id;
		}
		// store data for view
    	$data['page_title']='User edit';
		$data['user']=$user;
		$data['roles']=$roles;
		$data['assigned_roles']=$assigned_roles;
        return view('admin.user_add',$data);
    }
    /**
     * delte roles.
     *
     * @return view
     */
    public function user_delete($user_id)
    {
		$user = User::find($user_id);
        $user->delete();
		$user_role = UserRoles::where('user_id',$user_id);
        $user_role->delete();
		$user_profile = UserProfile::where('user_id',$user_id);
		if(isset($user_profile) && !empty($user_profile)){
			$user_profile->delete();
		}
		$consultant_profile = ConsultantProfile::where('user_id',$user_id);
		if(isset($consultant_profile) && !empty($consultant_profile)){
			$consultant_profile->delete();
		}
        return redirect('admin/users')->with('status', 'User deleted!');
    }
	/**
     * Create a new controller instance for pages.
     *
     * @return view
     */
    public function pages()
    {
    	//$pages=Role::paginate(2);
        $pages=Page::all();
    	$data['page_title']='Pages';
    	$data['pages']=$pages;
        return view('admin.pages',$data);
    }
	/**
     * delete pages.
     *
     * @return view
     */
    public function page_delete($page_id)
    {
        $page = Page::find($page_id);
        $page->delete();
        return redirect('admin/pages')->with('status', 'Page deleted!');
    }
	/**
     * add new page.
     *
     * @return view
     */
    public function page_create(Request $request)
    {
		if(!isset($request['title'])){
			$data['page_title']='Add page';
			return view('admin.page_add',$data);
		}
		$validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
			'machine_name' => 'required|unique:pages',
			'desc' => 'required',
        ]);
        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }
		$page_id=$request['page_id'];
		$page_title=trim($request['title']);
		$machine_name=trim($request['machine_name']);
		$machine_name=str_replace(' ', '_', $machine_name);
		$page_desc=trim($request['desc']);
		$form_type=trim($request['form_type']);
		$msg='';

		if($form_type=='create') {
			// create page
			Page::create([
				'page_title' => $page_title,
				'machine_name' => $machine_name,
				'description' => $page_desc,
			]);
			$msg='Page "'.$page_title.'" created!';
		}elseif($form_type=='edit'){
			// Update page.
			$page = Page::find($page_id);
			$page->page_title = $page_title;
			$page->machine_name=$machine_name;
			$page->description = $page_desc;
			$page->save();
			$msg='Page is updated!';
		}

        return redirect('admin/pages')->with('status', $msg);
	}
	/**
     * edit page.
     *
     * @return view
     */
    public function page_edit($page_id)
    {
		$page=Page::find($page_id);
		$data['page_title']='edit page';
		$data['page']=$page;
		return view('admin.page_add',$data);
	}
	/**
     * Create a new controller instance for pages.
     *
     * @return view
     */
    public function navigation()
    {
        $navigation=Navigation::all();
    	$data['page_title']='Navigation';
    	$data['navigations']=$navigation;
        return view('admin.navigation',$data);
    }
	/**
     * delete navigations.
     *
     * @return view
     */
    public function navigation_delete($nav_id)
    {
        $nav = Navigation::find($nav_id);
        $nav->delete();
        return redirect('admin/navigation')->with('status', 'Navigation deleted!');
    }
	/**
     * add new navigation.
     *
     * @return view
     */
    public function navigation_create()
    {
		$data['page_title']='Add Navigation';
		$data['navigation']='';
		return view('admin.navigation_add',$data);
	}
	/**
     * add new navigation.
     *
     * @return view
     */
    public function navigation_store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
			'path' => 'required|max:400',
        ]);

        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }

		$nav_id=$request['nav_id'];
		$nav_title=trim($request['title']);
		$nav_path=trim($request['path']);
		$form_type=trim($request['form_type']);
		$msg='';

			if($form_type=='create') {
			// create page
			Navigation::create([
				'title' => trim($nav_title),
				'path' => trim($nav_path),
			]);
			$msg='Navigation "'.$nav_title.'" created!';
		}elseif($form_type=='edit'){
			// Update page.
			$navigation = Navigation::find($nav_id);
			$navigation->title = $nav_title;
			$navigation->path = $nav_path;
			$navigation->save();
			$msg='Navigation is updated!';
		}

        return redirect('admin/navigation')->with('status', $msg);
	}
	/**
     * edit page.
     *
     * @return view
     */
    public function navigation_edit($nav_id)
    {
		$nav_obj=Navigation::find($nav_id);
		$data['page_title']='Edit navigation';
		$data['navigation']=$nav_obj;
		return view('admin.navigation_add',$data);
	}

	public function settings(){
		$settings=Setting::find(1);
		//echo '<pre>';print_r($settings);exit;

		if(!isset($settings) && empty($settings)){
			$setting_obj['website_email'] = 'info@wexplore.com';
			$settings = Setting::create($setting_obj);
		}

		$data['page_title']='Settings';
		$data['settings']=$settings;
		return view('admin.settings',$data);
	}

	public function settings_store(Request $request){
		$settings=Setting::find(1);
		$request_arr = array();
		$base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
		
		if(empty($settings['logo'])){
			$request_arr['logo'] = 'required|image';
		}

		$request_arr['website_email'] = 'required|max:255';
		$request_arr['timings'] = 'required|max:255';		

		if($request['facebook_active'] == 1){
			$request_arr['facebook_url'] = 'required|max:255';
		}

		if($request['twitter_active'] == 1){
			$request_arr['twitter_url'] = 'required|max:255';
		}

		if($request['linkedin_active'] == 1){
			$request_arr['linkedin_url'] = 'required|max:255';
		}

		if($request['google_plus_active'] == 1){
			$request_arr['google_plus_url'] = 'required|max:255';
		}

		if($request['behance_active'] == 1){
			$request_arr['behance_url'] = 'required|max:255';
		}

		$request_arr['location_address'] = 'required';
		$request_arr['website_phone'] = 'required|max:255';
		$request_arr['contact_us_email'] = 'required|email|max:255';
		$request_arr['copyright'] = 'required|max:255';
		
		$validator = Validator::make($request->all(),$request_arr);

        if ($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors())->withInput();
        }
		
		$logo_img = $request->file('logo');

		if(empty($settings['logo'])) {
			$settings_arr['logo'] = Setting::saveUploadedImage($logo_img,$settings->logo);
		} else {
			$settings_arr['logo'] = Setting::saveUploadedImage($logo_img);
		}

		if(!empty($request['website_email'])){
			$settings_arr['website_email'] = $request['website_email'];
		}

		if(!empty($request['timings'])){
			$settings_arr['timings'] = $request['timings'];
		}

		$settings_arr['facebook_active'] = $request['facebook_active'];

		if($request['facebook_active'] == 1){
			$settings_arr['facebook_url'] = $request['facebook_url'];
		}

		$settings_arr['twitter_active'] = $request['twitter_active'];

		if($request['twitter_active'] == 1){
			$settings_arr['twitter_url'] = $request['twitter_url'];
		}

		$settings_arr['linkedin_active'] = $request['linkedin_active'];

		if($request['linkedin_active'] == 1){
			$settings_arr['linkedin_url'] = $request['linkedin_url'];
		}

		$settings_arr['google_plus_active'] = $request['google_plus_active'];

		if($request['google_plus_active'] == 1){
			$settings_arr['google_plus_url'] = $request['google_plus_url'];
		}

		$settings_arr['behance_active'] = $request['behance_active'];

		if($request['behance_active'] == 1){
			$settings_arr['behance_url'] = $request['behance_url'];
		}

		if(!empty($request['location_address'])){
			$settings_arr['location_address'] = $request['location_address'];
		}

		if(!empty($request['website_phone'])){
			$settings_arr['website_phone'] = $request['website_phone'];
		}

		if(!empty($request['contact_us_email'])){
			$settings_arr['contact_us_email'] = $request['contact_us_email'];
		}

		if(!empty($request['copyright'])){
			$settings_arr['copyright'] = $request['copyright'];
		}

		$settings_obj = Setting::find(1)->update($settings_arr);
		return redirect('admin/settings');
	}

	public function consultants(Request $request) {
		$data['page_title'] = 'Consultants';
		$end_date = date('Y-m-d');
		$start_date = '0000-00-00';

		if($request->get('start_date') != '') {
			$start_date = $request->get('start_date');
			$data['start_date'] = $start_date;
		}

		if($request->get('end_date') != '') {
			$end_date = $request->get('end_date');
			$data['end_date'] = $end_date;
		}

		$users = User::from( 'users as user_alias' )
			->join( 'user_roles as role', \DB::raw( 'role.user_id' ), '=', \DB::raw( 'user_alias.id' ) )
			->join( 'consultant_profile as consultant', \DB::raw( 'consultant.user_id' ), '=', \DB::raw( 'user_alias.id' ) )
			->select( \DB::raw( 'user_alias.*' ) )
			->where('role.role_id',2)
			->whereNull('user_alias.deleted_at')
			->whereBetween(\DB::raw('DATE(user_alias.created_at)'), [$start_date, $end_date])
			->orderBy('consultant.company')
			->get();

			//dd($users);

		$data['users'] = $users;
		return view('admin.consultants',$data);
	}
	
	public function consultant_show($id)
	{
		$data['page_title']='Consultant Profile';
		$user = User::find($id);
		$data['consultant'] = $user;
		$cc_code=Country::all();
		$data['countries_code'] = $cc_code;
		$model = new ConsultantProfile();
		$data['areas'] = ConsultantProfile::getExpertiesOptions();
		return view('admin.consultant_profile',$data);
	}

	public function consultant_activate(Request $request,$id) {
		$user = User::find($id);

		$user->update([
			'is_active' => $request->get('is_active')
		]);
		$cons_serv = ConsultantServices::where('service_id', $request->get('service_id'))->where('user_id', $id)->first();
		$service_name = ConsultantServices::getServiceName($request->get('service_id'));
		$data = [
			'user_id' => $id,
			'service_id' => $request->get('service_id'),
			'state_id' => $request->get('is_active'),
			'service_name' => $service_name
		];

		if($cons_serv == null) {
			$cons_serv = ConsultantServices::create($data);
		}else{
			$cons_serv->update($data);
		}
		if(!strstr($user->consultantProfile->area_expertise,$request->get('service_id') )) {
			$user->consultantProfile->update([
				'area_expertise' => $user->consultantProfile->area_expertise.','.$request->get('service_id')
			]);
		}
		// array dei "problemi/questioni" non ancora assegnati ad alcun consultant e il cui paese matcha col paese di expertise del consultant
		$dream_check_labs = DreamCheckLab::whereNull('validate_by')->where('interest_country',$user->consultantProfile->country_expertise)->get();

		$pro_kit_activate = ConsultantServices::where('user_id',$id)->where('state_id',ConsultantServices::STATE_ACTIVE)
			->where('service_id',ConsultantServices::SERVICE_PROFESSIONAL_KIT)->first();

		if(count($dream_check_labs) > 0 && $pro_kit_activate != null) {
			foreach ($dream_check_labs as $dream_check_lab) {
				$dream_check_lab->update([
					'validate_by' => $id
				]);

				$to_email = $user->email;
				$user->consultantProfile->increment('email_count');
				$data['dream_check_lab_id'] = $dream_check_lab->id;
				\Mail::send('emails.dream_check_consultant_notification', ['data' => $data],
					function ($m) use ($to_email) {
						$settings = Setting::find(1);
						$site_email = $settings->website_email;
						$m->from($site_email, 'Wexplore');
						$m->to($to_email, 'Wexplore')->subject('Dream Check Lab Submission!');
					});


				$user_obj = $dream_check_lab->createUser;
				$to_email = $user_obj->email;
				\Mail::send('emails.dream_check_client_notification', ['data' => $data],
					function ($m) use ($to_email) {
						$settings = Setting::find(1);
						$site_email = $settings->website_email;
						$m->from($site_email, 'Wexplore');
						$m->to($to_email, 'Wexplore')->subject('Dream Check Lab: Assigned Consultant!');
					});
			}

		}
		
		return redirect()->back()->with('status', 'Successfully Changed Status');
	}

	public function update(Request $request, $id)
	{
		$base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
		$user_id = $id;
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'surname' => 'required|max:255',
			'profile_picture' => 'image',
			'password' => 'confirmed|min:6',
			//'email' => 'required|email|max:255|unique:users,email,'.$user_id,
			'gender' => 'required',
			'date_of_birth' => 'required',
			'qualification' => 'required',
			'industry_expertise' => 'required',
			'country_expertise' => 'required',
			'languages' => 'required',
			'vat_number' => 'required',
			'pin_number' => 'required',
			'address' => 'required',
			'bank_details' => 'required',
			'oigp_company' => 'required',
			'area_expertise'=>'required',
			'bio' => 'required',
			'bank_iban' => 'required',
			'city' => 'required',
			'company' => 'required',

		]);
		//echo '<pre>';print_r($validator->fails());exit;
		if($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}

		$profile_picture_path='';
		$profile_image = $request->file('profile_picture');
		$profile_data['profile_picture'] = Setting::saveUploadedImage($profile_image);
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
		$profile_data['vat_number'] =  $request['vat_number'];
		$profile_data['pin_number'] =  $request['pin_number'];
		$profile_data['address'] =  $request['address'];
		$profile_data['bank_details'] = $request['bank_details'];
		$profile_data['oigp_company'] = $request['oigp_company'];
		$profile_data['experience'] = $request['experience'];
		$profile_data['bio'] = $request['bio'];
		$profile_data['bank_iban'] = $request['bank_iban'];
		$profile_data['company'] = $request['company'];
		$profile_data['city'] = $request['city'];

		if(empty($request['allow_personal_data'])){
			$profile_data['allow_personal_data'] = 0;
		}
		else{
			$profile_data['allow_personal_data'] = $request['allow_personal_data'];
		}

		$user_profile = ConsultantProfile::where('user_id',$user_id)->get();

		if($user_profile->count()>0){
			ConsultantProfile::where('user_id',$user_id)->update($profile_data);
		}
		else{
			ConsultantProfile::create($profile_data);
		}

		User::find($user_id)->update(['is_profile_complete'=>1]);
		return redirect('admin/consultant/'.$id.'/profile/view')->with('status', 'Profile Updated!');
	}

	public function user_view($id)
	{
		$user = User::find($id);
		$data['page_title']='Client Profile';

		if($user->role->role_id == 2)
			$data['page_title']='Consultant Profile';

		if($user != null) {
			$data['user'] = $user;
			$cc_code = Country::all();
			$data['countries_code'] = $cc_code;
			$model = new ConsultantProfile();
			$data['areas'] = ConsultantProfile::getExpertiesOptions();
			return view('admin.form_user_profile', $data);
		}else {
			return redirect()->back()->with('error', 'Page Not Found');
		}
	}

	public function user_update($id)
	{
		$data['page_title']='Consultant Profile';
		$user = User::find($id);
		$data['consultant'] = $user;
		$cc_code=Country::all();
		$data['countries_code'] = $cc_code;
		$model = new ConsultantProfile();
		$data['areas'] = ConsultantProfile::getExpertiesOptions();
		return view('admin.consultant_profile',$data);
	}

	public function save_meeting(ConsultantBooking $b) {
		$meeting = GoToMeeting::where('booking_id', $b->id)->first();

		if($meeting != null)
			$data = $b->saveMeeting();

	}

	public function queries() {
		$data['page_title'] = 'Client Queries';
		$queries = GlobalToolQuery::all();
		$data['queries'] = $queries;
		return view('admin.queries',$data);
	}

	public function export_excel(Request $request) {
		$users = User::join('user_roles', 'user_roles.user_id', '=', 'users.id')
			->join('user_profile', 'user_profile.user_id', '=', 'users.id')
			->orderBy('user_profile.created_at')
			->where('user_roles.role_id', 1)->get();
		$data = [];

		foreach ($users as $user) {
			$user_array = [
				'name' => $user->name,
				'surname' => $user->surname,
				'email' => $user->email,
				'created_at' => $user->created_at
			];
			$profile_data = [];

			if(isset($user->userProfile->id)) {
				$profile_data = $user->userProfile->toArray();
				unset($profile_data['allow_personal_data']);
				unset($profile_data['user_id']);
				unset($profile_data['is_active']);
				unset($profile_data['deleted_at']);
				unset($profile_data['id']);
				unset($profile_data['profile_picture']);
				unset($profile_data['updated_at']);
			}

			$data[] = array_merge($user_array,$profile_data);
		}

		$filename = 'export_users';
		User::exportToExcel($filename, $data);
	}

	public function consultant_export_excel() {
		$users = User::join('user_roles', 'user_roles.user_id', '=', 'users.id')
			->join('consultant_profile','consultant_profile.user_id', '=', 'users.id')
			->orderBy('consultant_profile.id', 'DESC')
			->where('user_roles.role_id', 2)->get();
		$data = [];

		foreach ($users as $user) {
			$user_array = [
				'name' => $user->name,
				'surname' => $user->surname,
				'email' => $user->email,
				'created_at' => $user->created_at
			];
			$profile_data = [];

			if (isset($user->consultantProfile->id)) {
				$profile_data = $user->consultantProfile->toArray();
				unset($profile_data['allow_personal_data']);
				unset($profile_data['user_id']);
				unset($profile_data['is_active']);
				unset($profile_data['deleted_at']);
				unset($profile_data['id']);
				unset($profile_data['profile_picture']);
				unset($profile_data['updated_at']);
				unset($profile_data['email_count']);
				$profile_data['area_expertise'] = ConsultantProfile::getExpertiesOptions($user->consultantProfile->area_expertise);
			}
			$data[] = array_merge($user_array,$profile_data);
		}

		$filename = 'export_users';
		User::exportToExcel($filename, $data);
	}

}
