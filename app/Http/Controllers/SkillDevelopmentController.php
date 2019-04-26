<?php

namespace App\Http\Controllers;

use App\Country;
use App\Event;
use App\EventBooking;
use App\OrderTransaction;
use App\PreferentialCodes;
use App\Service;
use App\Setting;
use App\Tags;
use App\User;
use App\UserProfile;
use App\UserRoles;
use App\UserSubscription;
use App\VideoCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Order;
use Validator;
use Illuminate\Http\Request;
use App\SkillDevelopmentVideos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkillDevelopmentController extends CustomBaseController
{
    public function __construct(){
		parent::__construct();
	//	$this->middleware('redirectToUserProfile', ['except' => 'getLogout']);
	}

    public function browse(Request $request) {
        $data['page_title'] = 'Skill Development';
        $videos = SkillDevelopmentVideos::with(['videoCategory','videoTag']);
        $data['tag_names']  = '';
        $data['category_name'] = '';

        if($request->get('q') != '') {
            $query = $request->get('q');
            $videos->where('video_title','LIKE','%'.$query.'%')->get();
        }

        if($request->get('category')) {
            $category = $request->get('category');
            $category_name = VideoCategory::where('id',$category)->first();

            if($category_name != null) {
                $data['category_name'] = $category_name->category_name;
                $videos->where('video_category', $category);
            }

        }

        if($request->get('tag')) {
            $tag = $request->get('tag');
            $tag_arr = explode(';',$tag);
            $tag_arr = array_filter($tag_arr);
            $tag_arr = array_map('trim', $tag_arr);
            $tag_objs = Tags::wherein('name',$tag_arr)->get();
            $tag_name_ar = [];
            $tag_id_ar = [];

            foreach($tag_objs as $tag_obj) {
                $tag_name_ar[] = $tag_obj->name;
                $tag_id_ar[] = $tag_obj->id;
            }

            $data['tag_names'] = implode('; ',$tag_name_ar);
            $videos->join('video_tags','video_tags.video_id', '=', 'skill_development_videos.id' )->wherein('video_tags.tag_id',$tag_id_ar);
        }

        $tags = Tags::all();

        foreach($tags as $tag) {
            $data['tags'][] = [
                'label'=>$tag->name,
                'value'=>$tag->id
            ];
        }

        $categories = VideoCategory::all();
        $data['videos'] = $videos->get();
    //    echo '<pre>';print_r( $data['videos']);exit;
        $data['categories'] = $categories;
        $today = Setting::getDateTime(date('Y-m-d'), false);
        $today = date('Y-m-d', strtotime($today));
        $events = Event::where('event_date','>',$today)->get();
        $data['events'] = $events;
        $events_arr = [];

        foreach($events as $event) {
            $events_arr[] = [
                'title' => $event->name.'(€'.$event->price.')',
                'to_url' => url('event/'.$event->id.'/purchase'),
                'start' => $event->getDate().' '.$event->getDate(\App\ConsultantAvailablity::START_TIME),
                'description' => $event->description,
                'image' => asset($event->image_file),
                'end_time' => $event->getDate(\App\ConsultantAvailablity::END_TIME)
            ];
        }

        $data['events_arr'] = $events_arr;

        return view('front.browse_skills',$data);
    }

    public function purchase(Request $request, $id) {
        $video = SkillDevelopmentVideos::where('id',$id)->first();
        $amount = $video->price;
        $data['user'] = [];
        $data['userProfile'] = [];

        if(!Auth::check()){
            $current_route_url = \Illuminate\Support\Facades\Request::url();
            Session::put('login_redirect',$current_route_url);
        }else{
            $data['user'] =Auth::user();

            if($data['user'] != null) {
                $user_video = UserSubscription::where('video_id',$video->id)->where('end_date','>=',date('Y-m-d'))->first();

                if($user_video != null) {
                  return redirect('user/myvideos')->with('status', 'Payment has been completed!');
                }

                if($video->checkPackage()) {
                    $video->saveVideo();
                    return redirect('user/myvideos')->with('status', 'Payment has been completed!');
                }

                $userProfile = Auth::user()->userProfile;

                if($userProfile != null) {
                    $data['userProfile'] = $userProfile;
                }

            }

        }

        $code = $request->get('code');

        if($code != null && $amount > 0) {
            $code_arr = $video->checkCode($code);

            if (isset($code_arr['id']) && isset($code_arr['amount'])) {
                $data['code'] = $code;
                $discount_amount = $code_arr['amount'];
                $original_amount = $video->price - $discount_amount;
                $amount = Service::usdprice('EUR', 'USD', $original_amount);
                $data['discount_amount'] = $discount_amount;
            }

        }

        $amount = round($amount);

        $data['amount'] = $amount;
        $country_list = Country::all();

        if(empty($country_list)){
            $country_list = [];
        }

        $data['country_list'] = $country_list;
        $data['page_title'] = 'Purchase Skill Development Video';
        $data['video'] = $video;
        $data['url'] = url('video/'.$id.'/purchase');
        $data['amount'] = $video->price;

        return view('front.service_payment',$data);
    }

    public function service_detail(Request $request) {
        $arr = [
            'status' => 'NOK'
        ];

        if($request->get('service_id') != null) {
            $service = Service::where('id',$request->get('service_id'))->first();
            $arr['price'] = $service->price;
            $arr['usdprice'] = round($service->usdprice($service->currency_code,'USD',$service->price));
            $arr['vatprice'] = round($service->vatprice());
            $arr['vat'] = round($service->vatprice() * 22/100) ;
            $arr['name'] = $service->name;
            $arr['status'] = 'OK';
            Session::put('payment_service_id',$service->id);
        }

        return $arr;
    }

    public function purchase_video(Request $request) {
        $post_amount = $request->get('amount');
        $video_id		=	$request['service_id'];
        $payment_method	=	$request['payment_method'];
        $rules['name'] = 'required|max:255';
        $rules['surname'] ='required|max:255';

        if(!Auth::check()) {
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['password'] = 'required|confirmed|min:6';
        }

        $rules['pan'] = 'required';
        //$rules['company'] = 'required';
        $rules['address'] = 'required';
        $rules['country'] = 'required';
        $rules['city'] = 'required';
        $rules['zip_code'] = 'required';
        $rules['tos'] = 'required';

        if($post_amount > 0) {
            $rules['payment_method_nonce'] = 'required';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $user_data['name'] = $request->get('name');
        $user_data['surname'] =  $request->get('surname');

        if(!Auth::check()) {
            $user_data['email'] = $request->get('email');
            $password = $request->get('password');
            $user_data['password'] = bcrypt($password);
        }

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

        if($tos == 'on') {
            $user_data['tos'] = 1;
        }

        $user = [];

        if(Auth::check()) {
            $user_obj = Auth::user();
        }else {
            $user_obj = User::where('email', $user_data['email'])->first();
        }

        $nonceFromTheClient = $request->get("payment_method_nonce");
        $video = SkillDevelopmentVideos::find($video_id);
        $original_amount = $video->price;
        $amount = Service::usdprice('EUR','USD',$video->price);
        $code = $request->get('code_id');
        $code_id = 0;
        $discount = 0;

        if($code != null) {
            $code_arr = $video->checkCode($code);

            if (!isset($code_arr['id']) || !isset($code_arr['amount'])) {
                $code_arr['code_error'] = 'Invalid Code';
                return $code_arr;
            }

            $code_id = $code_arr['id'];
            $discount = $code_arr['amount'];
            $original_amount = $video->price - $discount;
            $amount = Service::usdprice('EUR', 'USD', $original_amount);
        }

        $amount = round($amount);
        $result = \Braintree_Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True,
            ]
        ]);

        if($result->success == '1' || $amount <= 0) {

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

            if(!Auth::check()) {
                $credentials = $this->getCredentialsConsultant($request);

                if (Auth::attempt($credentials, $request->has('remember'))) {
                    $user_id = Auth::user()->id;

                    if (Session::has('login_redirect')) {
                        $redirect_url = Session::get('login_redirect');
                        Session::forget('login_redirect');
                    }

                }

            }else{
                $user_id = Auth::user()->id;
            }

            $user_order_data = [
                'user_id' => $user_obj->id,
                'item_id' => $video_id,
                'item_name' => $video->video_title,
                'item_type' => 'video',
                'item_amount' => $video->price,
                'approved' => 1
            ];
            $order_obj = \App\Order::create($user_order_data);
            $order_id = $order_obj->id;
            $txn_id = 'FREE-TRANSACTION-'.$user_obj->id;

            if($result->success == '1') {
                $txn_id = $result->transaction->id;
            }

            $transaction_data = [
                'order_id' => $order_id,
                'transaction_id' => $txn_id,
                'amount' => $original_amount,
                'transaction_type' => 'credit',
                'payment_gateway_id' => 2,
                'payment_method_id' => 1,
                'order_status' => 1,
                'type_id' => OrderTransaction::TYPE_VIDEO,
                'created_by' => Auth::user()->id,
                'code_id' => $code_id
            ];

            $payment_method = 'Paypal';

            if(isset($result->transaction->paypal)) {
                $transaction_data['paypal_data'] = json_encode($result->transaction->paypal);
                $transaction_data['payment_method_id'] = 2;
            }

            if(isset($result->transaction->creditCard)) {
                $transaction_data['credit_card_data'] = json_encode($result->transaction->creditCard);
                $transaction_data['payment_method_id'] = 1;
                $payment_method = isset($result->transaction->creditCard->cardType) ? $result->transaction->creditCard->cardType : "Credit Card";
                $payment_method .= isset($result->transaction->creditCard->last4) ? '(************'.$result->transaction->creditCard->last4.')' : "";
            }

            $transaction_obj = OrderTransaction::create($transaction_data);

            if($transaction_obj != null) {
                $subscription_arr['video_id'] = $video_id;
                $subscription_arr['transaction_id'] = $transaction_obj->id;
                $subscription_arr['user_id'] = $user_id;
                $subscription_arr['start_date'] = date('Y-m-d');
                $subscription_arr['end_date'] = date('Y-m-d', strtotime("+180 days"));
                $subscription_obj = UserSubscription::create($subscription_arr);

                $service_name =  $video->video_title;

                // // invoice gener
                // $data['order_obj'] = $order_obj;
                // $settings = Setting::find('1');
                // $data['settings'] = $settings;
                // $data['price'] =  $video->price;
                // $data['total'] =  $original_amount;
                // $data['product_name'] = $service_name;
                // $data['payment_method'] = $payment_method;
                // $data['page_title'] = 'Order Invoice';
                // $data['discount'] = $discount;
                // $data['vat_price'] = round($video->vatprice() * 22/100) ;
                // $pdf = \App::make('dompdf.wrapper');
                // $pdf->loadView('client.invoice_pdf', $data);
                // $invoice_pdf_path = base_path().'/../uploads/invoice_'.time().'.pdf';
                // $pdf->save($invoice_pdf_path);


                $mail_data = [
                    'order_id' => $order_obj->id,
                    'product_name' => $service_name,
                    'quantity' => '1',
                    'price' => $video->price,
                    'subtotal' => $video->price,
                    'total' => $original_amount,
                    'payment_method' => $payment_method,
                    'user' => $user_obj,
                    'discount' => $discount,
                    'promo_code' => $code,
                    'vat_price' => round($video->vatprice() * 22/100)
                ];

                \Mail::send('emails.service_activation', $mail_data, function ($m) use ($user_obj) {
                    $settings=Setting::find(1);
                    $site_email = $settings->website_email;
                    $m->from($site_email, 'Wexplore');
                    // $m->attach($invoice_pdf_path);
                    $m->to($user_obj->email, $user_obj->name)->subject('Service Activation!');
                });
                // @unlink($invoice_pdf_path);

                return redirect('user/myvideos')->with('status', 'Payment has been completed!');
            }

        }

        return redirect('/videos')->with('error', 'Sorry your purchase couldn\'t be completed!');
    }

    public function events() {
        $data['page_title'] = 'Events';
        $today = Setting::getDateTime(date('Y-m-d'), false);
        $today = date('Y-m-d', strtotime($today));
        $events = Event::where('event_date','>',$today)->get();
        $data['events'] = $events;
        $events_arr = [];

        foreach($events as $event) {
            $events_arr[] = [
                'title' => $event->name.'(€'.$event->price.')',
                'to_url' => url('event/'.$event->id.'/purchase'),
                'start' => $event->getDate().' '.$event->getDate(\App\ConsultantAvailablity::START_TIME),
                'description' => $event->description,
                'image' => asset($event->image_file),
                'end_time' => $event->getDate(\App\ConsultantAvailablity::END_TIME)
            ];
        }

        $data['events_arr'] = $events_arr;

        return view('front.events',$data);
    }

    public function my_events() {

        if(!Auth::check())
            return redirect('/events');

        $data['page_title'] = 'Events';
        $bookings = EventBooking::where('user_id',Auth::user()->id)->get();

        $data['bookings'] = $bookings;
        return view('client.bookings',$data);
    }

    public function purchase_event(Request $request,$id) {
        $event = Event::where('id',$id)->first();

        if(Auth::check()) {

            if($event->alreadyBooked()) {
                return redirect('/user/events');
            }

        }

        $data['user'] = [];
        $data['userProfile'] = [];

        if(!Auth::check()){
            $current_route_url = \Illuminate\Support\Facades\Request::url();
            Session::put('login_redirect',$current_route_url);
        }else{
            $data['user'] =Auth::user();

            if($data['user'] != null) {
                $userProfile = Auth::user()->userProfile;

                if($userProfile != null) {
                    $data['userProfile'] = $userProfile;
                }

            }

        }

        $amount = $event->price;
        $code = $request->get('code');

        if($code != null && $amount > 0) {
            $code_arr = $event->checkCode($code);

            if (isset($code_arr['id']) && isset($code_arr['amount'])) {
                $data['code'] = $code;
                $discount_amount = $code_arr['amount'];
                $original_amount = $event->price - $discount_amount;
                $amount = Service::usdprice('EUR', 'USD', $original_amount);
                $data['discount_amount'] = $discount_amount;
            }

        }

        $amount = round($amount);
        $data['amount'] = $amount;
        $country_list = Country::all();

        if(empty($country_list)){
            $country_list = [];
        }

        $data['country_list'] = $country_list;
        $data['page_title'] = 'Book Event/Webinar Now';
        $data['event'] = $event;
        $data['url'] = url('event/'.$id.'/purchase');

        return view('front.service_payment',$data);
    }

    public function book_event(Request $request) {
        $event_id		=	$request['service_id'];
        $payment_method	=	$request['payment_method'];
        $rules['name'] = 'required|max:255';
        $rules['surname'] ='required|max:255';

        if(!Auth::check()) {
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['password'] = 'required|confirmed|min:6';
        }

        $rules['pan'] = 'required';
        //$rules['vat'] = 'required';
        //$rules['company'] = 'required';
        $rules['address'] = 'required';
        $rules['country'] = 'required';
        $rules['city'] = 'required';
        $rules['zip_code'] = 'required';
        $rules['tos'] = 'required';
        $rules['payment_method_nonce'] = 'required';
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $user_data['name'] = $request->get('name');
        $user_data['surname'] =  $request->get('surname');

        if(!Auth::check()) {
            $user_data['email'] = $request->get('email');
            $password = $request->get('password');
            $user_data['password'] = bcrypt($password);
        }

        $user_profile_data['pan'] = $request->get('pan');
        $user_profile_data['vat'] = $request->get('vat');
        $user_profile_data['company'] = $request->get('company');
        $user_profile_data['address'] = $request->get('address');
        $user_profile_data['country'] = $request->get('country');
        $user_profile_data['city'] = $request->get('city');
        $user_profile_data['telephone'] = $request->get('telephone');
        $user_profile_data['zip_code'] = $request->get('zip_code');
        $tos = $request->get('tos');
        $user_data['tos'] = 0;

        if($tos == 'on') {
            $user_data['tos'] = 1;
        }

        $user = [];

        if(Auth::check()) {
            $user_obj = Auth::user();
        }else {
            $user_obj = User::where('email', $user_data['email'])->first();
        }

        $nonceFromTheClient = $request->get("payment_method_nonce");
        $event = Event::find($event_id);
        $original_amount = $event->price;
        $amount = Service::usdprice('EUR','USD',$event->price);
        $code = $request->get('code_id');
        $code_id = 0;
        $discount = 0;
        if($code != null) {
            $code_arr = $event->checkCode($code);

            if (!isset($code_arr['id']) || !isset($code_arr['amount'])) {
                $code_arr['code_error'] = 'Invalid Code';
                return $code_arr;
            }

            $code_id = $code_arr['id'];
            $discount = $code_arr['amount'];
            $original_amount = $event->price - $amount;
            $amount = Service::usdprice('EUR', 'USD', $original_amount);
        }

        $amount = round($amount);
        $result = \Braintree_Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True,
            ]
        ]);

        if($result->success == '1' || $amount <= 0) {

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

            if(!Auth::check()) {
                $credentials = $this->getCredentialsConsultant($request);

                if (Auth::attempt($credentials, $request->has('remember'))) {
                    $user_id = Auth::user()->id;

                    if (Session::has('login_redirect')) {
                        $redirect_url = Session::get('login_redirect');
                        Session::forget('login_redirect');
                    }

                }

            }else{
                $user_id = Auth::user()->id;
            }

            $user_order_data = [
                'user_id' => $user_obj->id,
                'item_id' => $event->id,
                'item_name' => $event->name,
                'item_type' => 'event',
                'item_amount' => $event->price,
                'approved' => 1
            ];
            $order_obj = \App\Order::create($user_order_data);
            $order_id = $order_obj->id;
            $txn_id = 'FREE-TRANSACTION-'.$user_obj->id;

            if($result->success == '1') {
                $txn_id = $result->transaction->id;
            }

            $transaction_data = [
                'order_id' => $order_id,
                'transaction_id' => $txn_id,
                'amount' => $original_amount,
                'transaction_type' => 'credit',
                'payment_gateway_id' => 2,
                'payment_method_id' => 1,
                'order_status' => 1,
                'type_id' => OrderTransaction::TYPE_EVENT,
                'created_by' => Auth::user()->id,
                'code_id' => $code_id
            ];
            $payment_method = 'Paypal';

            if(isset($result->transaction->paypal)) {
                $transaction_data['paypal_data'] = json_encode($result->transaction->paypal);
                $transaction_data['payment_method_id'] = 2;
            }

            if(isset($result->transaction->creditCard)) {
                $transaction_data['credit_card_data'] = json_encode($result->transaction->creditCard);
                $transaction_data['payment_method_id'] = 1;
                $payment_method = isset($result->transaction->creditCard->cardType) ? $result->transaction->creditCard->cardType : "Credit Card";
                $payment_method .= isset($result->transaction->creditCard->last4) ? '(************'.$result->transaction->creditCard->last4.')' : "";
            }

            $transaction_obj = OrderTransaction::create($transaction_data);

            if($transaction_obj != null) {
                $booking_arr['event_id'] = $event_id;
                $booking_arr['transaction_id'] = $transaction_obj->id;
                $booking_arr['user_id'] = $user_id;
                $booking_obj = EventBooking::create($booking_arr);

                $booking_obj->registerWebinar();

                $service_name =  $event->name;

                // // invoice generat
                // $data['order_obj'] = $order_obj;
                // $settings = Setting::find('1');
                // $data['settings'] = $settings;
                // $data['price'] =  $event->price;
                // $data['total'] =  $original_amount;
                // $data['product_name'] = $service_name;
                // $data['payment_method'] = $payment_method;
                // $data['page_title'] = 'Order Invoice';
                // $data['discount'] = $discount;
                // $data['vat_price'] = round($event->vatprice() * 22/100) ;
                // $pdf = \App::make('dompdf.wrapper');
                // $pdf->loadView('client.invoice_pdf', $data);
                // $invoice_pdf_path = base_path().'/../uploads/invoice_'.time().'.pdf';
                // $pdf->save($invoice_pdf_path);


                $mail_data = [
                    'order_id' => $order_obj->id,
                    'product_name' => $service_name,
                    'quantity' => '1',
                    'price' => $event->price,
                    'subtotal' => $event->price,
                    'discount' => $amount,
                    'total' => $original_amount,
                    'payment_method' => $payment_method,
                    'user' => $user_obj,
                    'promo_code' => $code,
                    'vat_price' => round($event->vatprice() * 22/100)
                ];

                \Mail::send('emails.service_activation', $mail_data, function ($m) use ($user_obj) {
                    $settings=Setting::find(1);
                    $site_email = $settings->website_email;
                    $m->from($site_email, 'Wexplore');
                    // $m->attach($invoice_pdf_path);
                    $m->to($user_obj->email, $user_obj->name)->subject('Service Activation!');
                });
                // @unlink($invoice_pdf_path);

                return redirect('user/events')->with('status', 'Payment has been completed!');
            }

        }

        return redirect('events')->with('status', 'Sorry your purchase couldn\'t be completed');
    }

    public function auto_complete(Request $request) {
        $query = $request->get('term','');
        $tags=Tags::where('name','LIKE','%'.$query.'%')->get();
        $data=array();

        foreach ($tags as $tag) {
            $data[]=array('value'=>$tag->name,'id'=>$tag->id);
        }

        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Videos Listing';
        $videos = SkillDevelopmentVideos::with(['videoCategory','videoTag']);
        $data['tag_names']  = '';
        $data['category_name'] = '';

        if($request->get('q') != '') {
            $query = $request->get('q');
            $videos->where('video_title','LIKE','%'.$query.'%')->get();
        }

        if($request->get('category')) {
            $category = $request->get('category');
            $category_name = VideoCategory::where('id',$category)->first();

            if($category_name != null) {
                $data['category_name'] = $category_name->category_name;
                $videos->where('video_category', $category);
            }

        }

        if($request->get('tag')) {
            $tag = $request->get('tag');
            $tag_arr = explode(';',$tag);
            $tag_arr = array_filter($tag_arr);
            $tag_arr = array_map('trim', $tag_arr);
            $tag_objs = Tags::wherein('name',$tag_arr)->get();
            $tag_name_ar = [];
            $tag_id_ar = [];

            foreach($tag_objs as $tag_obj) {
                $tag_name_ar[] = $tag_obj->name;
                $tag_id_ar[] = $tag_obj->id;
            }

            $data['tag_names'] = implode('; ',$tag_name_ar);
            $videos->join('video_tags','video_tags.video_id', '=', 'skill_development_videos.id' )->wherein('video_tags.tag_id',$tag_id_ar);
        }

        $tags = Tags::all();

        foreach($tags as $tag) {
            $data['tags'][] = [
                'label'=>$tag->name,
                'value'=>$tag->id
            ];
        }

        $categories = VideoCategory::all();
        $data['videos'] = $videos->get();
        $data['categories'] = $categories;

        return view('front.skill_development_videos',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shows($id)
    {
        $video = SkillDevelopmentVideos::find($id);
        $data['page_title'] = 'Video- '.$video->video_title;
        $data['video'] = $video;

        return view('front.video_view',$data);
    }

    public function show($id)   // !! SISTEMARE: METODO RAGGIUNGIBILE SIA DA ADMIN SIA DA USER NON LOGGATO. 
    {
        $video = SkillDevelopmentVideos::find($id);
        // $subscription = UserSubscription::where('user_id',Auth::user()->id)->where('video_id',$id)->first();
        $data['page_title'] = 'Video- ' . $video->video_title;
        $data['video'] = $video;

        /*if($subscription != null) {
            if ($subscription->end_date >= date('Y-m-d')) {
                $data['purchased'] = 1;
            }
        }*/
        
        return view('front.video_view', $data);
    }

    protected function getCredentialsConsultant(Request $request)
    {
        return $request->only('email', 'password');
    }
}
