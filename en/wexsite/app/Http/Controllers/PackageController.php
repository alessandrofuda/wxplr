<?php

namespace App\Http\Controllers;

use App\Country;
use App\EventBooking;
use App\Event;
use App\Order;
use App\OrderTransaction;
use App\Package;
use App\PreferentialCodes;
use App\Service;
use App\SkillDevelopmentVideos;
use App\User;
use App\UserPackage;
use App\UserProfile;
use App\UserRoles;
use App\UserSubscription;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PackageController extends CustomBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Packages';
        $packages = Package::all();
        $packages_arr = [];
        foreach ($packages as $package) {
            $packages_arr[$package->id] = array(
                'title'=>$package->title,
                'id'=>$package->id,
                'price'=>$package->price,
                'description'=>$package->description,
                'purchased'=>'no'
            );
        }

        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $user_package = UserPackage::where('user_id', $user_id)->where('package_id', $package->id)->first();
            if ($user_package != null) {
                $packages_arr[$package->id]['purchased'] = 'yes';
            }else{
                $packages_arr[$package->id]['purchased'] = 'no';
            }
        }
        $data['packages'] = $packages_arr;
        return view('front.packages',$data);
    }

    public function my() {
        $packages = UserPackage::where('user_id',Auth::user()->id)->get();
        $data['packages'] = $packages;
        $data['page_title'] = 'Packages';
        return view('client.packages',$data);
    }
    public function buy($id) {
        $package = Package::where('id',$id)->first();
        $data['amount'] = $package->price;
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
        $country_list = Country::all();
        if(empty($country_list)){
            $country_list = [];
        }
        $data['country_list'] = $country_list;
        $data['page_title'] = 'Buy Package';
        $data['package'] = $package;
        $data['url'] = url('package/'.$id.'/buy');
        return view('front.service_payment',$data);
    }
    public function buy_store(Request $request) {
        $package =	$request['service_id'];
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
        $user_profile_data['address'] = $request->get('address');
        $user_profile_data['country'] = $request->get('country');
        $user_profile_data['company'] = $request->get('company');
        $user_profile_data['city'] = $request->get('city');
        $user_profile_data['telephone'] = $request->get('telephone');
        $user_profile_data['zip_code'] = $request->get('zip_code');
        $tos = $request->get('tos');
        $user_data['tos'] = 0;
        if($tos == 'on')
            $user_data['tos'] = 1;
        $user = [];
        if(Auth::check()) {
            $user_obj = Auth::user();
        }else {
            $user_obj = User::where('email', $user_data['email'])->first();
        }
        $nonceFromTheClient = $request->get("payment_method_nonce");

        $package_obj = Package::find($package);
        $original_amount = $package_obj->price;
        $amount = Service::usdprice('EUR','USD',$package_obj->price);
        $code = $request->get('code_id');
        $code_id = 0;
        $discount = 0;
        if($code != null) {
            $code_arr = $package_obj->checkCode($code);
            if (!isset($code_arr['id']) || !isset($code_arr['amount'])) {
                $code_arr['code_error'] = 'Invalid Code';
                return $code_arr;
            }
            $code_id = $code_arr['id'];
            $discount = $code_arr['amount'];
            $original_amount = $package_obj->price - $discount;
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

            $user_package_arr['package_id'] = $package_obj->id;
            $user_package_arr['user_id'] = $user_id;
            $user_package_obj = UserPackage::create($user_package_arr);
            $used_count = '';
            $code_obj = [];
            if($user_package_obj != null) {
                $skill_arr = explode('-',$package_obj->skills);
                $count_arr = explode('-',$package_obj->count);
                $item_arr = explode('-',$package_obj->items);
                $skill_count_arr = array_combine($skill_arr, $count_arr);
                $skill_item_arr = array_combine($skill_arr, $item_arr);
                $code_arr['preferential_code'] = 'PACKAGE_CODE_'.$user_package_obj->id;
                $code_arr['type_id'] = PreferentialCodes::PRODUCT_TYPE_USER_PACKAGE;
                $code_arr['product_id'] = $user_package_obj->id;
                $code_arr['discount'] = 100;
                $code_arr['is_single'] = PreferentialCodes::SINGLE_USAGE;
                $code_arr['end_date'] = date('Y-m-d',strtotime('+1 year'));
                foreach($skill_count_arr as $skill => $count) {
                    if($skill == Package::SKILL_PROFESSIONAL_KIT) {
                        $use_c = $count - 1;
                        $used_count .= '-'.$use_c;
                        if($code_obj == null) {
                            $code_obj = PreferentialCodes::create($code_arr);
                        }
                        $user_package_obj->update([
                            'code_id' => $code_obj->id
                        ]);
                        $service = Service::where('name','Professional Kit')->first();
                        $user_order_data = [
                            'user_id' => $user_obj->id,
                            'item_id' => $service->id,
                            'item_name' => $service->name,
                            'item_type' => 'service',
                            'item_amount' => 0,
                            'approved' => 1
                        ];
                        $order_obj = Order::where('user_id',$user_obj->id)->where('item_name',$service->name)->first();
                        if($order_obj != null) {
                            $order_obj = Order::create($user_order_data);
                        }
                       
                    }elseif($skill == Package::SKILL_GLOBAL_TOOL_BOX) {
                        $use_c = $count - 1;
                        $used_count .= '-'.$use_c;
                        if($code_obj == null) {
                            $code_obj = PreferentialCodes::create($code_arr);
                        }
                        $user_package_obj->update([
                            'code_id' => $code_obj->id
                        ]);
                        $service = Service::where('name','Global Toolbox')->first();
                        $user_order_data = [
                            'user_id' => $user_obj->id,
                            'item_id' => $service->id,
                            'item_name' => $service->name,
                            'item_type' => 'service',
                            'item_amount' => 0,
                            'approved' => 1
                        ];
                        $order_obj = Order::where('user_id',$user_obj->id)->where('item_name',$service->name)->first();
                        if($order_obj != null) {
                            $order_obj = Order::create($user_order_data);
                        }
                    }elseif($skill == Package::SKILL_VIDEOS){
                        $video_ids = $skill_item_arr[$skill];
                        $video_id_arr = explode(',',$video_ids);
                        $use_c = $count;
                        $videos = SkillDevelopmentVideos::whereIn('id',$video_id_arr)->get();
                        if(count($videos) == $count && count($videos) != 0 ) {
                            foreach ($videos as $video) {
                                $use_c = $use_c - 1;
                                $user_order_data = [
                                    'user_id' => $user_obj->id,
                                    'item_id' => $video->id,
                                    'item_name' => $video->video_title,
                                    'item_type' => 'video',
                                    'item_amount' => $video->price,
                                    'approved' => 1
                                ];
                                $order_obj = \App\Order::create($user_order_data);
                                $order_id = $order_obj->id;
                                $txn_id = 'FREE-TRANSACTION-' . $user_obj->id;
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
                                if (isset($result->transaction->paypal)) {
                                    $transaction_data['paypal_data'] = json_encode($result->transaction->paypal);
                                }
                                if (isset($result->transaction->creditCard)) {
                                    $transaction_data['credit_card_data'] = json_encode($result->transaction->creditCard);
                                }
                                $transaction_obj = OrderTransaction::create($transaction_data);
                                if ($transaction_obj != null) {
                                    $subscription_arr['video_id'] = $video->id;
                                    $subscription_arr['transaction_id'] = $transaction_obj->id;
                                    $subscription_arr['user_id'] = $user_id;
                                    $subscription_arr['start_date'] = date('Y-m-d');
                                    $subscription_arr['end_date'] = date('Y-m-d', strtotime("+180 days"));
                                    $subscription_obj = UserSubscription::create($subscription_arr);
                                }
                            }
                        }
                        $used_count .= '-' . $use_c;
                    }elseif($skill == Package::SKILL_WEBINAR){
                        $event_ids = $skill_item_arr[$skill];
                        $event_id_arr = explode(',',$event_ids);
                        $events = Event::whereIn('id',$event_id_arr)->get();
                        $use_c = $count;
                        if(count($events) == $count && count($events) != 0 ) {
                            foreach ($events as $event) {
                                $use_c = $use_c - 1;
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
                                $txn_id = 'FREE-TRANSACTION-' . $user_obj->id;
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
                                if (isset($result->transaction->paypal)) {
                                    $transaction_data['paypal_data'] = json_encode($result->transaction->paypal);
                                }
                                if (isset($result->transaction->creditCard)) {
                                    $transaction_data['credit_card_data'] = json_encode($result->transaction->creditCard);
                                }
                                $transaction_obj = OrderTransaction::create($transaction_data);
                                if ($transaction_obj != null) {
                                    $booking_arr['event_id'] = $event->id;
                                    $booking_arr['transaction_id'] = $transaction_obj->id;
                                    $booking_arr['user_id'] = $user_id;
                                    $booking_obj = EventBooking::create($booking_arr);
                                }
                            }
                        }
                        $used_count .= '-' . $use_c;
                    }else{
                        $used_count .= '-'.$count;
                    }
                }
            }
            $used_count = ltrim($used_count, '-');
            $user_package_obj->update([
                'used_count' => $used_count
            ]);

            $user_order_data = [
                'user_id' => $user_obj->id,
                'item_id' => $package_obj->id,
                'item_name' => $package_obj->title,
                'item_type' => 'package',
                'item_amount' => $package_obj->price,
                'approved' => 1
            ];
            $order_obj = \App\Order::create($user_order_data);
            $order_id = $order_obj->id;
            $txn_id = 'FREE-TRANSACTION-'.$user_obj->id;

            if($result->success == '1')
                $txn_id = $result->transaction->id;

            $transaction_data = [
                'order_id' => $order_id,
                'transaction_id' => $txn_id,
                'amount' => $original_amount,
                'transaction_type' => 'credit',
                'payment_gateway_id' => 2,
                'payment_method_id' => 1,
                'order_status' => 1,
                'type_id' => OrderTransaction::TYPE_PACKAGE,
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

            $data['order_obj'] = $order_obj;
            $settings = Setting::find('1');
            $data['settings'] = $settings;
            $data['price'] =  $package_obj->price;
            $data['total'] =  $original_amount;
            $data['product_name'] = $package_obj->title;;
            $data['payment_method'] = $payment_method;
            $data['page_title'] = 'Order Invoice';
            $data['discount'] = $discount;
            $data['vat_price'] = round($package_obj->vatprice() * 22/100) ;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('client.invoice_pdf', $data);
            $invoice_pdf_path = base_path().'/../uploads/invoice_'.time().'.pdf';
            $pdf->save($invoice_pdf_path);

            $mail_data = [
                'order_id' => $order_obj->id,
                'product_name' => $package_obj->title,
                'quantity' => '1',
                'price' => $package_obj->price,
                'subtotal' => $package_obj->price,
                'total' => $original_amount,
                'payment_method' => $payment_method,
                'user' => $user_obj,
                'discount' => $discount,
                'promo_code' => $code,
                'vat_price' => round($package_obj->vatprice() * 22/100)
            ];

            \Mail::send('emails.service_activation', $mail_data, function ($m) use ($user_obj, $invoice_pdf_path) {
                $settings=Setting::find(1);
                $site_email = $settings->website_email;
                $m->from($site_email, 'Wexplore');
                $m->attach($invoice_pdf_path);
                $m->to($user_obj->email, $user_obj->name)->subject('Service Activation!');
            });
            @unlink($invoice_pdf_path);

            return redirect('user/dashboard')->with('status', 'Payment has been completed!');

        }
        return redirect('/package'.$package_obj->id.'/buy')->with('error', 'Sorry your purchase couldn\'t be completed!');
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
