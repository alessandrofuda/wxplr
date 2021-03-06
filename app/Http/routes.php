<?php
	ini_set('xdebug.max_nesting_level', 200);
	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It's a breeze. Simply tell Laravel the URIs it should respond to
	| and give it the controller to call when that URI is requested.
	|
	*/


	/* To load artisan commands without console CLI*/
	//Route::get('/pulisci-cache', function () {
	//    $exitCode = Artisan::call('cache:clear' //, [  optional options
	        //'user' => 1, '--queue' => 'default'
	    //]
	//	);

	    //
	//});



	// users API (provvisoria)
	Route::get('api/users/list/{token}', array('as'=>'usersLists','uses'=>'Api\UserController@lists'));





	// TEST ROUTES
	//Route::get('phpinfo', function(){
	//  return date('Y-m-d H:i:s');
	//	return phpinfo();
	//});
	/* Route::get('demo-email', function() {
		//$user->name = 'alessandro';
		//$user->email = 'test@test.com';
		$user = App\User::find(1042);

		return view('emails.service_activation')->with('order_id', 999)
												->with('product_name', 'product_test')
												->with('quantity', 2)
												->with('price', 456)
												->with('subtotal', 654)
												->with('discount', 100)
												->with('promo_code', null)
												->with('total', 951)
												->with('payment_method', 'credit card')
												->with('vat_price', 851)
												->with('user', $user)
												;
	}); */
	//Route::get('/token',function () {
	//	return \App\ConsultantBooking::getAccessToken();
	//});

	//Route::get('zoom_token', function() {
	//	return \App\ConsultantBooking::getZoomAccessToken();
	//});

	//Route::get('cancel_meeting_test', function() {
	//	$test = new \App\ConsultantBooking;
	//	return dd('ok: '.$test->cancelMeeting());
	//});

	//use Illuminate\Support\Facades\Mail;
	//use App\Setting;
	/*
	Route::get('send_email_test', function() {
		
		$test['data']['client_id'] = 1026;
		$test['data']['client_name'] = 'testing';
		$test['data']['dream_check_lab_id'] = 9999;

		return view('emails.dream_check_client_notification', $test );

		//$tests = ['Test1..', 'Test2..'];
		//Mail::send('emails.a_test', ['tests' => $tests], function ($m) use ($tests) {
	    //            $settings = Setting::find(1);
	    //            $site_email = $settings->website_email;
	    //            $m->from($site_email, 'Wexplore');
	    //            $m->to('alessandro.fuda@gmail.com', 'Ale_test')->subject('Testing...');
	    //        }); 
	});
	*/
	Auth::routes();


	Route::get('/', function() {
		return redirect('login');
	});
	Route::get('home', function(){
		return redirect('login');
	})->name('home');
	Route::get('auth/login', function(){
		return redirect('login');
	});

	Route::get('time', function() {
	    return date('Y-m-d H:i:s');  // getdate();
	});

    Route::post('/user/set-timezone', array('as' => 'set-timezone', 'uses' => 'PagesController@setTimezone'));

	//Blogs Routes
	Route::get('blogs', 'BlogController@index');
	Route::get('blog/{blog_id}/show', 'BlogController@show');
	Route::get('contact-us', array('as' => 'contact', 'uses' => 'PagesController@contactform'));
	Route::post('contact', array('as' => 'contact', 'uses' => 'PagesController@contact_send_email'));

	Route::get('culture_match/return_callback', ['as'=>'culture_match_callback','uses'=>'Admin\CultureMatchController@survey_return_callback']);

	// Authentication routes...
	Route::post('auth/login', array('as'=>'authLoginPost','uses'=>'Auth\AuthController@postLogin'));  // authenticated
	Route::get('auth/logout', array('as'=>'authLogout','uses'=>'Auth\AuthController@getLogout'));
	// Registration routes...
	Route::get('register', array('as' => 'register', 'uses' => 'Auth\AuthController@getRegister'));
	Route::post('register', array('as' => 'register', 'uses' => 'Auth\AuthController@postRegister'));
	Route::get('login', array('as' => 'login', 'uses' => 'Auth\AuthController@login'));
	Route::get('consultant/register', array('as' => 'consultant_register', 'uses' => 'Auth\AuthController@getConsultantRegister'));
	Route::post('consultant/register', array('as' => 'consultant_register_post', 'uses' => 'Auth\AuthController@postConsultantRegister'));
	Route::get('client/register', array('as' => 'client_register', 'uses' => 'Auth\AuthController@getClientRegister'));
	Route::post('client/register', array('as' => 'client_register', 'uses' => 'Auth\AuthController@postClientRegister'));
	// Service Payment
	//Route::get('service/payment', array('as'=>'service_payment','uses'=>'ServiceOrdersController@service_payment'));
	Route::get('service/payment/{service_id}', array('as'=>'service_payment_direct','uses'=>'ServiceOrdersController@service_payment'))->where('service_id', '5|6');
	Route::post('email-check', array('as' => 'email_check', 'uses' => 'ServiceOrdersController@emailCheck'));

	//Partner page
	Route::any('/partners','PagesController@partners');
	// Route::post('service/payment/checkout','ServiceOrdersController@checkout');
	// Route::post('service/payment/process', array('as' => 'payment_process', 'uses' => 'PaypalController@postPayment'));
	Route::post('service/payment/process', array('as' => 'payment_process', 'uses' => 'ServiceOrdersController@service_payment_process_braintree'));
	// returm url is required for the paypal direct payment only
	Route::get('service/payment/return_url', array('as' => 'paypal_return_url', 'uses' => 'PaypalController@return_url'));
	Route::post('service/payment/return_post_url', array('as' => 'paypal_return_post_url', 'uses' => 'PaypalController@return_post_url'));
	Route::get('service/payment/status', 'PaypalController@payment_status');
	// Service Page routes..
	Route::get('services', array('as'=>'frontServices','uses'=>'PagesController@showServices'));
	Route::post('services', array('as' => 'services', 'uses' => 'PagesController@service_send_email'));
	Route::post('aiesec', array('as' => 'aiesec', 'uses' => 'PagesController@aiesec_send_email'));
	
	//Buy Packages
	Route::get('packages', array('as'=>'frontServices','uses'=>'PackageController@index'));
	Route::get('/package/{package_id}/buy', 'PackageController@buy');
	Route::post('/package/{package_id}/buy', 'PackageController@buy_store');

	Route::get('thank-you/{service_id}', 'PagesController@thankYouPage');

	// Password reset link request routes...
	Route::get('password/email', array('as' => 'forgot-psw', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm')); // 'Auth\PasswordController@getEmail');
	Route::post('password/email', array('as' => 'forgot-psw-post', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'));  // 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', array( 'as'=>'password.reset', 'uses'=>'Auth\ResetPasswordController@showResetForm'));
	Route::post('password/reset', array('as'=>'auth.passwords.reset', 'uses'=>'Auth\ResetPasswordController@reset'));


	Route::group(['middleware' => ['auth']], function(){
		Route::get('user/download/{file}',['as' => 'download_file', 'uses' => 'ConsultantProfileController@download_file']);
		Route::group(['middleware' => 'userConsultant'], function(){
			Route::get('consultant/dashboard', ['as' => 'consultant.dashboard','uses' => 'ConsultantProfileController@index']);
			Route::get('consultant/event/list',  'ConsultantProfileController@events');
			Route::get('consultant/availability/form', 'ConsultantProfileController@availability_form');
			Route::post('consultant/availability/form', 'ConsultantProfileController@post_availability_form');
			Route::get('consultant/availability/{avail_id}/edit', 'ConsultantProfileController@edit_availability_form');
			Route::post('consultant/availability/{avail_id}/edit', 'ConsultantProfileController@update_availability_form');
			Route::delete('consultant/availability/{avail_id}/delete', 'ConsultantProfileController@destroy_availability');
			Route::get('consultant/availability/list', 'ConsultantProfileController@availability_list');
			Route::get('consultant/appoinment/list', 'ConsultantProfileController@appoinment_listing');

			//Cancel Booking
			Route::get('consultant/booking/{booking_id}/cancel', 'ConsultantProfileController@cancel_booking');

			//Booking user Profile
			//Route::get('user/{user_id}/profile', ['as'=>'form_user_profile','uses'=>'ConsultantProfileController@user_profile']);
			Route::get('booking/profile/{service_id}/{service_type}/detail', ['as'=>'form_user_profile','uses'=>'ConsultantProfileController@form_user_profile']);

			// Consultant Profile
			Route::get('consultant/profile', 'ConsultantProfileController@consultant_show');
			Route::get('consultant/profile/edit', 'ConsultantProfileController@edit');
			Route::post('consultant/profile/update', 'ConsultantProfileController@update');
			Route::post('consultant/profile/updatelogin', 'ConsultantProfileController@updatelogin');

			// Dream check lab submission
			Route::get('user/consultant/dream_check_lab/submission/{dreamcheck_id}',['as'=>'dreamcheck.lab.submission','uses' => 'ConsultantProfileController@dreamcheck_lab_submission']);
			Route::get('user/consultant/dream_check_lab/submission/feedback/{dreamcheck_id}',['as'=>'dreamcheck.lab.submission.feedback','uses' => 'ConsultantProfileController@dreamcheck_lab_submission_feedback']);
			Route::post('user/consultant/dream_check_lab/submission/feedback/store',['as' => 'dreamcheck.lab.submission.feedback.store','uses' =>  'ConsultantProfileController@dreamcheck_lab_submission_feedback_store']);

			// Client Consultant Discussion - lato consultant 
			Route::post('consultant/discussion', 'ProfessionalKitController@post_consultant_discussion');

			// meeting
			Route::get('consultant/meeting/{booking_id}',array('as'=>'consultant_start_meeting', 'uses' => 'GlobalToolController@start_meeting'));

			Route::get('/consultant/forms/list/', 'ConsultantProfileController@consultant_forms');
			Route::get('/download/{service_id}/{service_type}/feedback', 'ConsultantProfileController@download_feedback');

			//Upload Recording
			Route::post('consultant/meeting/{booking_id}/recording/upload',['as' => 'consultant.meeting.recording.upload','uses' =>  'GlobalToolController@upload_recording']);

			//Global Tool Box Feed back
			Route::get('consultant/global_tool_form/feedback/{global_tool_form}',['as'=>'global_tool_form_feedback','uses' => 'ConsultantProfileController@global_tool_form_feedback']);
			Route::post('consultant/global_tool_form/feedback/{global_tool_form}/store',['as' => 'global_tool_form_feedback.store','uses' =>  'ConsultantProfileController@global_tool_form_feedback_store']);
		});

		Route::group(['middleware' => 'userClient'], function(){
			Route::get('consultant/{booking_id}/{type_id}/calendar', 'ProfessionalKitController@availability_calender');
			Route::get('user/meeting/{booking_id}',array('as'=>'user_start_meeting', 'uses' => 'ProfessionalKitController@start_meeting'));
			Route::any('service/profile', array('as' => 'service_profile', 'uses' => 'ServiceOrdersController@service_profile'));
			Route::post('service/profile/save', 'ServiceOrdersController@service_profile_save');
			//Route::get('user/services', 'PagesController@services');
			Route::get('user/dashboard', ['as' => 'user.dashboard','uses' => 'PagesController@client_dashboard']);

			Route::get('get_address/{addr_id}', 'ServiceOrdersController@get_address');
			Route::get('user/orders', 'ServiceOrdersController@user_orders');
			Route::get('order/{order_id}/invoice', 'ServiceOrdersController@order_invoice');
			Route::get('order/{order_id}/download/invoice', 'ServiceOrdersController@download_order_invoice');

			// User Profile
			Route::get('user/profile', ['as'=>'user_profile','uses'=>'UserProfileController@index']);
			Route::get('user/profile/edit', ['as'=>'client.profile.edit','uses'=>'UserProfileController@edit']);
			Route::post('user/profile/update', 'UserProfileController@update');
			Route::post('user/profile/update_login', 'UserProfileController@updateLogin');
			Route::post('user/profile/update_personal', 'UserProfileController@updatePersonal');
			Route::post('user/profile/delete', 'UserProfileController@deletePersonal');
			Route::post('user/profile/upload-image', ['as'=>'user_profile_upload_image', 'uses'=>'UserProfileController@uploadImageViaAjax']);
			Route::get('user/profile/remove-image', ['as'=>'user_profile_remove_image', 'uses'=>'UserProfileController@removeImageViaAjax']);

			// Professional Kit
			Route::get('user/professional_kit', ['as'=>'professional.kit.step','uses'=>'ProfessionalKitController@overview']);
			Route::get('user/professional_kit/profile', ['as'=>'professional.kit','uses'=>'ProfessionalKitController@index']);
			Route::get('user/market_analysis', ['as' => 'market_analysis','uses'=>'ProfessionalKitController@market_analysis']);
			Route::get('user/culture_match',['as'=>'culture_match','uses' => 'ProfessionalKitController@culture_match_index']);
			Route::get('user/culture_match/submit',['as'=>'culture_match_submit_get','uses' => 'ProfessionalKitController@culture_match_index']);
			Route::post('user/culture_match/submit',['as'=>'culture_match_submit','uses' => 'ProfessionalKitController@culture_match_submit']);
			Route::get('culture/match/survey/{country}',['as'=>'culture_match_survey','uses' => 'ProfessionalKitController@culture_match_iframe']);
			Route::get('user/dream_check_lab', ['as'=>'dream.check.lab','uses'=>'ProfessionalKitController@dream_check_lab']);
			Route::post('user/dream_check_lab/store', ['as'=>'dream.check.lab.store','uses'=>'ProfessionalKitController@dream_check_lab_store']);
			Route::post('user/dream_check_lab/submit', ['as'=>'dream.check.lab.submit','uses'=>'ProfessionalKitController@dream_check_lab_submit']);
			Route::get('user/dream_check_lab/feedback/{dreamcheck_id}',['as'=>'dreamcheck.lab.submission.fb','uses' => 'ProfessionalKitController@dream_check_lab_submission_feedback']);

			// GOT free
			Route::get('global_orientation_test_intro', ['as'=>'got_intro', 'uses'=>'PagesController@global_online_test_intro']);
			Route::get('global_orientation_test', ['as'=>'got', 'uses'=>'PagesController@global_online_test']);
			Route::post('global_orientation_test', 'PagesController@global_online_test_next');
			Route::get('got-report', ['as'=>'got_report', 'uses'=>'PagesController@generateGotReport']);

			// Got PRO
			Route::get('user/got-pro', array('as'=>'got_pro', 'uses'=>'GotProController@index'));
			Route::get('user/got-pro/start', array('as'=>'got_pro_start', 'uses'=>'GotProController@start'));
			Route::get('got-pro-report', ['as'=>'got_pro_report', 'uses'=>'GotProController@generateReport']);

			// Career Ready / Vic
			Route::get('user/vic', array('as'=>'vic', 'uses'=>'VicController@index'));
			Route::get('user/vic/start', array('as'=>'vic_start', 'uses'=>'VicController@start'));
			Route::get('user/vic/middle', array('as'=>'vic_middle', 'uses'=>'VicController@middle'));
			Route::get('user/vic/completed', array('as'=>'vic_completed', 'uses'=>'VicController@completed'));
			Route::get('user/vic/preparation-report', array('as'=>'vic_preparation_report', 'uses'=>'VicController@generatePreparationReport'));
			Route::get('user/vic/job-hunt-report', array('as'=>'vic_job_hunt_report', 'uses'=>'VicController@generateJobHuntReport'));
			Route::get('user/vic/take-off-report', array('as'=>'vic_take_off_report', 'uses'=>'VicController@generateTakeOffReport'));
			Route::get('user/vic/report/document-download/{doc}', array('as'=>'vic_report_document_download', 'uses'=>'VicController@reportDocumentDownload'));
			Route::get('user/vic/{report_name}/download', array('as'=>'vic_userReport_download', 'uses'=>'VicController@userReportDownload'));
			Route::get('user/vic/preparation-report-ajax', array('as'=>'vic_preparation_report_ajax', 'uses'=>'VicController@generatePreparationReportAjax'));
			Route::get('user/vic/jobhunt-report-ajax', array('as'=>'vic_jobhunt_report_ajax', 'uses'=>'VicController@generateJobhuntReportAjax'));

			// Wow
			Route::get('user/wow', array('as'=>'wow', 'uses'=>'WowController@index'));
			Route::get('user/wow/start', array('as'=>'wow_start', 'uses'=>'WowController@start'));		

			// Skill Development
			Route::get('user/myvideos','UserSubscriptionController@my');
			Route::get('/user/events','SkillDevelopmentController@my_events');

			// Market analysis: download zip buttons
			Route::get('market_analysis/zip/download', array('as'=>'labourZipDownload', 'uses'=>'ProfessionalKitController@labourDownload'));
			Route::get('market_analysis/work/zip/download', array('as'=>'qualityWorkZipDownload', 'uses'=>'ProfessionalKitController@qualityWorkDownload'));
			Route::get('market_analysis/life/zip/download', array('as'=>'qualityLifeZipDownload', 'uses'=>'ProfessionalKitController@qualityLifeDownload'));
			
			// Role play interview
			Route::get('user/role_play_interview',['as' => 'role.play.interview', 'uses'=> 'ProfessionalKitController@role_play_interview']);
			Route::get('user/consultant/booked/list','ProfessionalKitController@consultant_booked_list');
			Route::get('user/consultant/list','ProfessionalKitController@consultant_list');
			Route::get('user/consultant/{consultant_id}/availabilities','ProfessionalKitController@availability_calender');
			Route::post('user/consultant/book','ProfessionalKitController@consultant_book');
			Route::post('user/consultant/booking/cancel','ProfessionalKitController@consultant_cancel_booking');

			// Client Consultant Discussion - lato client
			Route::post('user/discussion', 'ProfessionalKitController@post_user_discussion');

			//My documents
			Route::get('user/mydocuments',['as' =>'user.mydocuments', 'uses' => 'UserProfileController@mydocuments']);

			Route::get('/user/start/{booking_id}/meeting',['as'=>'start_meeting', 'uses' => 'ProfessionalKitController@start_meeting']);

			// STEADY, AIM, SHOOT
			Route::get('user/steady_aim_shoot',['as' => 'steady_aim_shoot', 'uses'=>'ProfessionalKitController@steady_aim_shoot']);
			//Global Tool Box
			Route::get('/user/global/dashboard', ['as'=>'user.global_dashboard','uses'=>'GlobalToolController@dashboard']);
			Route::get('/user/global/{query_id}/book', 'GlobalToolController@query_view');
			Route::post('/user/global/{query_id}/book', 'GlobalToolController@consultant_booking');

			//Appointments
			Route::get('/user/myappointments', 'GlobalToolController@appointments');
			Route::get('/user/booking/{booking_id}/cancel', 'GlobalToolController@cancel_appointment');
			Route::post('/user/order/step_update', 'GlobalToolController@updateOrdersTab');

			Route::get('/user/{form_id}/download', 'ProfessionalKitController@download_form');

			//My Packages
			Route::get('user/packages','PackageController@my');
		});  // end Auth userClient
		
		// ADMIN !!
		Route::group(['namespace' => 'Admin','middleware' => 'admin'], function(){

			Route::get('admin/save_meeting', 'AdminController@save_meeting');
			Route::get('admin/queries', 'AdminController@queries');
			Route::get('admin/booking/{booking_id}/view', 'EventController@booking_view');

			//Export User's Data
			Route::get('admin/export', 'AdminController@export_excel');
			Route::get('admin/consultant/export', 'AdminController@consultant_export_excel');

			Route::get('admin/user/{user_id}/view', 'AdminController@user_view');
			Route::get('admin/refund/{transaction_id}/transaction', ['as' => 'refund_transaction' , 'uses' =>'TransactionController@refund']);

			//Activate Consultant
			Route::post('admin/consultant/{consultant_id}/activate', 'AdminController@consultant_activate');

			Route::get('admin/dashboard', 'AdminController@index');
			Route::get('admin/roles', 'AdminController@roles');
			Route::post('admin/create_role', 'AdminController@create_role');
			Route::get('admin/role/{role_id}/edit', 'AdminController@role_edit');
			Route::delete('admin/role/{role_id}/delete', 'AdminController@role_delete');
			Route::any('admin/users', 'AdminController@users');
			Route::get('admin/user/add', 'AdminController@user_add');
			Route::post('admin/user/create', 'AdminController@user_create');
			Route::get('admin/user/{user_id}/edit', 'AdminController@user_edit');
			Route::post('admin/user/update', 'AdminController@user_create');
			Route::delete('admin/user/{user_id}/delete', 'AdminController@user_delete');

			Route::any('admin/consultants', 'AdminController@consultants');
			Route::any('admin/dream/{dream_id}/pdf', 'AdminController@dream_pdf');

			Route::get('admin/consultant/{consultant_id}/profile/view', 'AdminController@consultant_show');
			Route::post('admin/consultant/{consultant_id}/profile/update', 'AdminController@update');
			// pages
			Route::get('admin/pages', 'AdminController@pages');
			Route::match(['get', 'post'],'admin/page/add', 'AdminController@page_create');
			Route::get('admin/page/{page_id}/edit', 'AdminController@page_edit');
			Route::delete('admin/page/{page_id}/delete', 'AdminController@page_delete');
			// Navigation
			Route::get('admin/navigation', 'AdminController@navigation');
			Route::get('admin/navigation/add', 'AdminController@navigation_create');
			Route::post('admin/navigation/add', 'AdminController@navigation_store');
			Route::get('admin/navigation/{nav_id}/edit', 'AdminController@navigation_edit');
			Route::delete('admin/navigation/{nav_id}/delete', 'AdminController@navigation_delete');
			// Services
			Route::get('admin/services',  'ServiceController@index');
			Route::get('admin/service/create', 'ServiceController@create');
			Route::post('admin/service/create', 'ServiceController@store');
			Route::get('admin/service/{service_id}/edit', 'ServiceController@edit');
			Route::post('admin/service/{service_id}/edit/', 'ServiceController@update');
			Route::delete('admin/service/{service_id}/delete/', 'ServiceController@destroy');
			// Global Orientation test
			Route::get('admin/questions', 'GlobalTestController@index');
			Route::get('admin/question/create', 'GlobalTestController@create');
			Route::post('admin/question/create', 'GlobalTestController@store');
			Route::get('admin/question/{que_id}/edit', 'GlobalTestController@edit');
			Route::post('admin/question/{que_id}/edit/', 'GlobalTestController@update');
			Route::delete('admin/question/{que_id}/delete/', 'GlobalTestController@destroy');
			// Possible global test outcomes
			Route::get('admin/outcomes', 'GlobalTestController@outcomes');
			Route::get('admin/outcome/choices', 'GlobalTestController@outcome_choices');
			Route::get('admin/outcome/choice/{choice_id}/{question_id}/create', ['as' => 'outcome_create', 'uses' => 'GlobalTestController@outcome_create']);
			Route::post('admin/outcome/create', 'GlobalTestController@outcome_store');
			Route::delete('admin/outcome/{outcome_id}/delete/', 'GlobalTestController@outcomes_destroy');
			Route::get('admin/who_does_test', 'GlobalTestController@who_does_the_test');
			// Settings
			Route::get('admin/settings', 'AdminController@settings');
			Route::post('admin/settings', 'AdminController@settings_store');
			// Professional Kit
			Route::get('admin/market_analysis', 'ProfessionalKitController@market_analysis');
			Route::post('admin/market_analysis/agepdf', 'ProfessionalKitController@age_pdf_store');
			Route::post('admin/market_analysis/genderpdf', 'ProfessionalKitController@gender_pdf_store');
			Route::post('admin/market_analysis/industrypdf', 'ProfessionalKitController@industry_pdf_store');
			Route::post('admin/market_analysis/educationpdf', 'ProfessionalKitController@education_pdf_store');
			Route::post('admin/market_analysis/occupationpdf', 'ProfessionalKitController@occupation_pdf_store');
			Route::post('admin/market_analysis/contentpdf', 'ProfessionalKitController@market_analysis_content_pdf_store');
			Route::get('admin/steady_aim_shoot/country_pdf', 'ProfessionalKitController@upload_country_pdf');
			Route::post('admin/steady_aim_shoot/country_pdf/store', 'ProfessionalKitController@country_pdf_store');
			Route::get('admin/steady_aim_shoot/country_pdf/list', 'ProfessionalKitController@country_pdf_list');
			Route::get('admin/steady_aim_shoot/country_pdf/{country_pdf_id}/edit', 'ProfessionalKitController@country_pdf_edit');
			Route::get('admin/steady_aim_shoot', 'ProfessionalKitController@steady_aim_shoot');
			Route::post('admin/steady_aim_shoot/store', 'ProfessionalKitController@steady_aim_shoot_store');
			Route::get('admin/steady_aim_shoot/update', 'ProfessionalKitController@steady_aim_shoot_edit');
			Route::get('admin/dream_check_lab/assign_consultant/{dream_check_lab_id}', ['as'=>'dream.check.lab.assign.consultant','uses'=>'ProfessionalKitController@dream_check_lab_assign_consultant']);
			Route::post('admin/dream_check_lab/assign_consultant/{dream_check_lab_id}/update', ['as'=>'dream.check.lab.assign.consultant.update','uses'=>'ProfessionalKitController@dream_check_lab_assign_consultant_update']);
			// Culture Match
			Route::get('admin/cuture_match/survey_code', 'CultureMatchController@index');
			Route::get('admin/cuture_match/survey_code/upload', 'CultureMatchController@create');
			Route::post('admin/cuture_match/survey_code/upload', 'CultureMatchController@store');
			Route::get('admin/cuture_match/survey_code/{servey_id}/edit', 'CultureMatchController@edit');
			Route::post('admin/cuture_match/survey_code/{servey_id}/edit', 'CultureMatchController@update');
			Route::delete('admin/cuture_match/survey_code/{servey_id}/delete', 'CultureMatchController@destroy');
			Route::post('admin/culture_match/{user_id}/upload', 'CultureMatchController@upload');
			// SKill Development
			Route::get('admin/skill_development/category', 'SkillDevelopmentController@category');
			Route::get('admin/skill_development/category/{category_id}/edit', 'SkillDevelopmentController@category_edit');
			Route::post('admin/skill_development/category/{category_id}/edit', 'SkillDevelopmentController@category_update');
			Route::delete('admin/skill_development/category/{category_id}/delete', 'SkillDevelopmentController@destroy_category');
			Route::post('admin/skill_development/category', 'SkillDevelopmentController@category_save');
			Route::get('admin/skill_development/categories', 'SkillDevelopmentController@categories');
			Route::get('admin/skill_development/videos', 'SkillDevelopmentController@index');
			Route::get('admin/skill_development/video/add', 'SkillDevelopmentController@create');
			Route::post('admin/skill_development/video/add', 'SkillDevelopmentController@store');
			Route::get('admin/skill_development/video/{video_id}/edit', 'SkillDevelopmentController@edit');
			Route::post('admin/skill_development/video/{video_id}/edit', 'SkillDevelopmentController@update');
			Route::delete('admin/skill_development/video/{video_id}/delete', 'SkillDevelopmentController@destroy');
			Route::get('admin/skill_development/video/{video_id}/view', 'SkillDevelopmentController@show');


			//Events/Live Webinars
			Route::get('admin/events', 'EventController@index');
			Route::get('admin/event/add', 'EventController@create');
			Route::post('admin/event/add', 'EventController@store');
			Route::get('admin/event/{event_id}/edit', 'EventController@edit');
			Route::post('admin/event/{event_id}/edit', 'EventController@update');
			Route::get('admin/event/{event_id}/view', 'EventController@show');

			// Role play interview
			Route::get('admin/booked/consultant/list', 'ProfessionalKitController@index');
			Route::get('admin/codes', 'PreferentialController@index');
			Route::get('admin/code/add', 'PreferentialController@create');
			Route::post('admin/code/add', 'PreferentialController@store');
			Route::get('admin/code/{code_id}/edit', 'PreferentialController@edit');
			Route::post('admin/code/{code_id}/edit', 'PreferentialController@update');
			Route::delete('admin/code/{code_id}/delete', 'PreferentialController@destroy');

			//Blog
			Route::get('admin/blogs', 'BlogController@index');
			Route::get('admin/blog/{blog_id}/show', 'BlogController@show');
			Route::get('admin/blog/add', 'BlogController@create');
			Route::post('admin/blog/add', 'BlogController@store');
			Route::get('admin/blog/{blog_id}/edit', 'BlogController@edit');
			Route::post('admin/blog/{blog_id}/edit', 'BlogController@update');
			Route::delete('admin/blog/{blog_id}/delete', 'BlogController@destroy');

			//Reports
			Route::get('admin/transactions', 'TransactionController@index');

			//Meta Tags
			Route::get('admin/meta-tags', 'MetaTagsController@index');
			Route::get('admin/meta-tags/{tag_id}/show', 'MetaTagsController@show');
			Route::get('admin/meta-tags/add', 'MetaTagsController@create');
			Route::post('admin/meta-tags/add', 'MetaTagsController@store');
			Route::get('admin/meta-tags/{tag_id}/edit', 'MetaTagsController@edit');
			Route::post('admin/meta-tags/{tag_id}/edit', 'MetaTagsController@update');
			Route::delete('admin/meta-tags/{tag_id}/delete', 'MetaTagsController@destroy');

			//Slider Settings
			Route::get('admin/slider/settings', 'SliderSettingsController@index');
			Route::get('admin/slider/add', 'SliderSettingsController@create');
			Route::post('admin/slider/add', 'SliderSettingsController@store');
			Route::get('admin/slider/{slider_id}/edit', 'SliderSettingsController@edit');
			Route::post('admin/slider/{slider_id}/edit', 'SliderSettingsController@update');
			Route::delete('admin/slider/{slider_id}/delete', 'SliderSettingsController@destroy');

			//Global Tool Box
			Route::get('admin/queries', 'GlobalToolController@index');
			Route::get('admin/query/{query_id}/view', 'GlobalToolController@show');
			Route::get('admin/query/{query_id}/edit', 'GlobalToolController@edit');
			Route::post('admin/query/{query_id}/edit', 'GlobalToolController@update');

			//Packages
			Route::get('admin/package/list', 'PackageController@index');
			Route::get('admin/package/add', 'PackageController@create');
			Route::post('admin/package/add', 'PackageController@store');
			Route::get('admin/package/{page_id}/view', 'PackageController@view');
			Route::get('admin/package/{page_id}/edit', 'PackageController@edit');
			Route::post('admin/package/{page_id}/edit', 'PackageController@update');
			Route::delete('admin/package/{page_id}/delete', 'PackageController@destroy');

			//Partners
			Route::get('admin/partners', 'PartnerController@index');
			Route::get('admin/partner/add', 'PartnerController@create');
			Route::post('admin/partner/add', 'PartnerController@store');
			Route::get('admin/partner/{page_id}/view', 'PartnerController@view');
			Route::get('admin/partner/{page_id}/edit', 'PartnerController@edit');
			Route::post('admin/partner/{page_id}/edit', 'PartnerController@update');
			Route::delete('admin/partner/{page_id}/delete', 'PartnerController@destroy');
		});  // end Admin
	}); // end Auth middleware




	
	Route::get('skill_development/browse','SkillDevelopmentController@browse');
	Route::get('skill_development/videos','SkillDevelopmentController@index');
	Route::post('skill_development/videos','SkillDevelopmentController@index');

	// convertire queste rotte/controllers per il nuovo servizio wow (NO LOGGED USER !!)
	Route::get('video/{video_id}/purchase','SkillDevelopmentController@purchase');
	Route::post('video/{video_id}/purchase','SkillDevelopmentController@purchase_video');
	Route::get('video/{video_id}/view',[ 'as'=>'video_view','uses' =>  'SkillDevelopmentController@show']);
	Route::post('skill_development/code','SkillDevelopmentController@code');
	Route::post('skill_development/payment_code','SkillDevelopmentController@payment_code');

	Route::post('service_detail','SkillDevelopmentController@service_detail');
	Route::get('/events','SkillDevelopmentController@events');
	Route::get('/event/{event_id}/purchase','SkillDevelopmentController@purchase_event');
	Route::post('/event/{event_id}/purchase','SkillDevelopmentController@book_event');
	Route::get('/event/{event_id}/view','EventController@show');

	Route::get('/global_toolbox','GlobalToolController@index');
    Route::post('/global/query','GlobalToolController@query');


    /*others mix */
    Route::get('autocomplete', array('as'=>'autocomplete', 'uses'=>'SkillDevelopmentController@all'));
	Route::get('searchajax', array('as'=>'searchajax', 'uses'=>'SkillDevelopmentController@auto_complete'));
	Route::post('availcode', array('as'=>'availcode', 'uses'=>'ServiceOrdersController@availCode'));

	Route::get('get-download/{file_name}', 'PagesController@getDownload');

	// unsubscribe link in Clients side email text (spatie/laravel-url-signer 1.0.0 package)
	Route::get('user/{user_id}/delete-account', array('middleware'=>'signedurl', 'as'=>'delete-account', 'uses'=>'UserProfileController@deletePersonalFromEmailLink'));

	Route::get('termini-del-servizio', ['as'=>'terms_service', 'uses'=>'PagesController@termsService']);



















    /*  IMPORTANT: this is the LAST route !! */
	/* !!! Please make sure to place this route at the end of route file, Otherwise some pages may not work !!! */
	/* this machine_name param include this pages: about-us, contact-us, terms-service, privacy-policy, cookies-policy, code-ethics, servicesb, global-orientation-test, professional-kit, global-toolbox, skills-development, aiesec, faq, ... */
	Route::get('/{machine_name}', array('as'=>'getContent', 'uses'=>'PagesController@getContent')); /*!! the LAST !!*/
	