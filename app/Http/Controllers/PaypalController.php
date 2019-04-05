<?php

namespace App\Http\Controllers;

use App\Setting;
use App\UserProfile;
use App\User;
use App\UserRoles;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;

use URL;
use Session;
use Redirect;
use Validator;
use App\Order;
use App\OrderTransaction;
use Auth;
use App\Service;

class PaypalController extends CustomBaseController
{
    private $_api_cdirecontext;
    public function __construct()
    {
		parent::__construct();
        // setup PayPal api context
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function postPayment(Request $request)
    {
        $service_price  =   $request['amount'];
		$service_name	=	$request['service_name'];
		$service_id		=	$request['service_id'];
		$payment_method	=	$request['payment_method'];
		$rules['name'] = 'required|max:255';
		$rules['surname'] ='required|max:255';
		if(!Auth::check()) {
			$rules['email'] = 'required|email|max:255|unique:users';
			$rules['password'] = 'required|confirmed|min:6';
		}
		$rules['pan'] = 'required';
		$rules['address'] = 'required';
		$rules['country'] = 'required';
		$rules['city'] = 'required';
		$rules['telephone'] = 'required';
		$rules['zip_code'] = 'required';
		$rules['tos'] = 'required';
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
		if($user_obj != null) {
			$user_obj = $user_obj->update($user_data);
			$profile = $user_obj->userProfile;
			$user_profile_data['user_id'] = $user_obj->id;
			if($profile != null) {
				$profile->update($user_profile_data);
			}else{
				$profile_obj = UserProfile::create($user_profile_data);
			}
		}else {
			$user_obj = User::create($user_data);
			$user_profile_data['user_id'] = $user_obj->id;
			$profile_obj = UserProfile::create($user_profile_data);
			$role_arr = array('user_id' => $user_obj->id, 'role_id' => 1);
			$ur = UserRoles::create($role_arr);
			$credentials = $this->getCredentialsConsultant($request);

			if (Auth::attempt($credentials, $request->has('remember'))) {
				if(Session::has('login_redirect')){
					$redirect_url=Session::get('login_redirect');
					Session::forget('login_redirect');
				}
			}
		}
		if($payment_method=='credit_card') {
			$returnUrl = URL::route('paypal_return_post_url', ['id'=>$user_obj->id, 'success' => 'true', 'service_id' => $service_id]);
			$cancelUrl = URL::route('paypal_return_post_url', ['success' => 'false']);
			$setting = Setting::first();
			$business_email = 'test@wexplore.com';
			if($setting != null) {
				$business_email = $setting->paypal_email;
				}
			$query = array();
			$query['return'] = $returnUrl;
			$query['cancel_return'] = $cancelUrl;
			$query['cmd'] = '_xclick';
			$query['rm'] = '2';
			$query['upload'] = '1';
			$query['business'] = $business_email;
			$query['address_override'] = '1';
			$query['first_name'] = $user_obj->name;
			$query['last_name'] = $user_obj->sirname;
			$query['email'] = $user_obj->email;
			$query['item_name'] = $service_name;
			$query['quantity' ] = 1;
			$query['amount'] = $service_price;
			$query['currency'] = 'USD';
			// Prepare query string

			$query_string = http_build_query($query);
			$approvalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string;
			return Redirect::away($approvalUrl);
		}else {
			// Payment vai paypal id
			$payer = new Payer();
			$payer->setPaymentMethod("paypal");

			$item1 = new Item();
			$item1->setName($service_name)
				->setDescription($service_name)
				->setCurrency('USD')
				->setQuantity(1)
				->setPrice($service_price);

			$itemList = new ItemList();
			$itemList->setItems(array($item1));

			$amount = new Amount();
			$amount->setCurrency("USD")
				->setTotal($service_price);

			$transaction = new Transaction();
			$transaction->setAmount($amount)
				->setItemList($itemList)
				->setDescription("Payment description")
				->setInvoiceNumber(uniqid());

			$returnUrl = URL::route('paypal_return_url', ['success' => 'true', 'service_id' => $service_id]);
			$cancelUrl = URL::route('paypal_return_url', ['success' => 'false']);
			$redirectUrls = new RedirectUrls();
			$redirectUrls->setReturnUrl($returnUrl)
				->setCancelUrl($cancelUrl);

			$payment = new Payment();
			$payment->setIntent("sale")
				->setPayer($payer)
				->setRedirectUrls($redirectUrls)
				->setTransactions(array($transaction));

			$request = clone $payment;

			try {
				$payment->create($this->_api_context);
			} catch (Exception $ex) {
				//echo '<pre>2222'; print_r($request); echo '</pre>';
				//echo '<pre>3333333'; print_r($ex); echo '</pre>'; die;
				redirect('service/payment/status')->with('error', 'Something went wrong! Please try again!');
			}
			$approvalUrl = $payment->getApprovalLink();
			Session::put('paypal_payment_id', $payment->getId());
			return Redirect::away($approvalUrl);
		}
		return redirect('service/payment')->with('error', 'No payment method selected!');

    }
	public function return_post_url(Request $request) {

		if (empty($request['payer_id']) || empty($request['txn_id'])) {
			return redirect('service/payment/status')->with('error', 'Payment failed');
		}
		//echo '<pre>';print_r($request->all());echo '</pre>';exit; // DEBUG RESULT, remove it later
		if ($request->get('payment_status') == 'Completed') { // payment made
			//update database
			$user = Auth::user();
			if($user == null) {
				$user = User::where('id',$request->get('id'))->first();
			}
			$user_id = $user->id;
			$service_id = $request['service_id'];
			$service = Service::find($service_id, ['name', 'price']);
			$user_order_data = [
				'user_id' => $user_id,
				'item_id' => $service_id,
				'item_name' => $service->name,
				'item_type' => 'service',
				'item_amount' => $service->price,
				'approved' => 1
			];
			$order_obj = Order::create($user_order_data);
			$order_id = $order_obj->id;
			$transaction_data = [
				'order_id' => $order_id,
				'transaction_id' => $request->get('txn_id'),
				'amount' => $service->price,
				'transaction_type' => 'credit',
				'payment_gateway_id' => 1,
				'payment_method_id' => 1,
				'order_status' => 1
			];
			OrderTransaction::create($transaction_data);
			// forget the session of the service used to get service info for payment
			Session::forget('payment_service_id');
			return redirect('service/payment/status')->with('success', 'Payment has been completed successfully!');
		}
		}
	/**
	 * returm url is required for the paypal direct payment only
	 * no need return url for paypal credit card payment
	 */
	public function return_url(Request $request){
		 // Get the payment ID before session clear
        //echo 'pppp'.$payment_id = Session::get('paypal_payment_id');
		//echo '<br><pre>'; print_r($request['PayerID']); echo '</pre>'; die;
        // clear the session payment ID
        //Session::forget('paypal_payment_id');

		if (empty($request['PayerID']) || empty($request['token'])) {
			return redirect('service/payment/status')->with('error', 'Payment failed');
        }
		$payment_id = $request['paymentId'];
		$payment = Payment::get($payment_id, $this->_api_context);
		// PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
        $execution->setPayerId($request['PayerID']);
        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') { // payment made
            //update database
			$user=Auth::user();
			$user_id=$user->id;
			$service_id=$request['service_id'];
			$service=Service::find($service_id,['name','price']);
			$user_order_data=[
							'user_id'=>$user_id,
							'item_id'=>$service_id,
							'item_name'=>$service->name,
							'item_type'=>'service',
							'item_amount'=> $service->price,
							'approved'=>1
							];
			$order_obj=Order::create($user_order_data);
			$order_id=$order_obj->id;
			$transaction_data=[
							   'order_id'=>$order_id,
							   'transaction_id'=>$result->getId(),
							   'amount'=>$service->price,
							   'transaction_type'=>'credit',
							   'payment_gateway_id' => 1,
							   'payment_method_id' => 2,
							   'order_status'=>1
							   ];
			OrderTransaction::create($transaction_data);
			// forget the session of the service used to get service info for payment
			Session::forget('payment_service_id');
			return redirect('service/payment/status')->with('success', 'Payment has been completed successfully!');
        }

	}
	public function payment_status(){
		$data['page_title']='Payment Status';
		return view('front.service_payment_status',$data);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
		return $request->only('name', 'password');
	}
}
