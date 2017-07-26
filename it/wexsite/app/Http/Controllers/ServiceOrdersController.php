<?php

namespace App\Http\Controllers;

use App\CultureMatchSurvey;
use App\OrderTransaction;
use App\PreferentialCodes;
use App\Setting;
use App\SkillDevelopmentVideos;
use App\SurveyCode;
use App\UserPackage;
use App\UserProfile;
use App\UserRoles;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Psy\Test\Exception\RuntimeExceptionTest;
use Route;
use Response;
use Validator;
use App\User;
use App\Country;
use App\Service;
use App\Order;
use App\UserAddress;
use App\Event;
use Session;
use Braintree_TestHelper;

use Illuminate\Support\Facades\Log;

class ServiceOrdersController extends CustomBaseController {

	public function availCode(Request $request) {
		$rules['service_id'] = 'required';
		$rules['code'] = 'required';
		$rules['type'] = 'required';
		$code_arr['status'] = 'NOK';
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return $validator->messages()->toJson();
		}

		$type = $request->get('type');
		$object = [];
		$currency = 'EUR';

		if($type == OrderTransaction::TYPE_SERVICE) {
			$object = Service::where('id',$request->get('service_id'))->first();
			$currency = $object->currency_code;
		} elseif($type == OrderTransaction::TYPE_VIDEO) {
			$object = SkillDevelopmentVideos::where('id',$request->get('service_id'))->first();
		} else {
			$object = Event::where('id',$request->get('service_id'))->first();
		}

		// Log::info("OBJ: " . print_r($object, true));

		if($object != null) {
			$code = $request->get('code');
			$amount = 0;
			if ($code != null) {
				$code_arr = $object->checkCode($code);
				if (!isset($code_arr['id']) || !isset($code_arr['amount'])) {
					$code_arr['code_error'] = 'Invalid Code';
					return $code_arr;
				}

				// Log::info("PROMO_CODE: " . print_r($code_arr, true));

				$code_arr['status'] = 'OK';
				$amount = round($code_arr['amount'], 2);
				$total = $object->price - $amount;

				$code_arr['total'] = round($total, 2);
				// Log::info("AMOUNT: " . $amount);
				// Log::info("TOTAL: " . $total);

				$total_usd = Service::usdprice($currency, 'USD', $total);
				// Log::info("TOTAL USD: " . $total_usd);
				$total_usd = round($total_usd, 2);
				// Log::info("TOTAL USD ROUND: " . $total_usd);

				$code_arr['total_usd'] = round($total, 2);

				// Log::info("RET ARRAY: " . print_r($code_arr, true));
				return $code_arr;
			}
		}
		return $code_arr;
	}

    public function service_payment(Request $request, $id = null) {
		$data['user'] = [];
		$data['userProfile'] = [];

		if(!Auth::check()) {
			$current_route_url = \Illuminate\Support\Facades\Request::url();
			Session::put('login_redirect',$current_route_url);
		} else {
			$data['user'] =Auth::user();

			if($data['user'] != null) {
				$userProfile = Auth::user()->userProfile;

				if($userProfile != null) {
					$data['userProfile'] = $userProfile;
				}
			}
		}

		$service_id='';

		if(!empty($request['service_id'])) {
			$service_id=$request['service_id'];
			Session::put('payment_service_id',$service_id);
		} elseif($id != null) {
			$service_id = $id;
			Session::put('payment_service_id',$service_id);
		} elseif(Session::has('payment_service_id')) {
			$service_id=Session::get('payment_service_id');
		}

		$service = Service::find($service_id,['id','name','description','price','currency_code']);
		$amount = 0;

		if($service != null) {
			$amount = $service->price;
			$code = $request->get('code');

			if($code != null && $amount > 0) {
				$code_arr = $service->checkCode($code);

				if (isset($code_arr['id']) && isset($code_arr['amount'])) {
					$data['code'] = $code;
					$discount_amount = $code_arr['amount'];
					$original_amount = $service->price - $discount_amount;
					$amount = Service::usdprice($service->currency_code, 'USD', $original_amount);
					$amount = $original_amount;
					$data['discount_amount'] = $discount_amount;
				}
			}

			$amount = round($amount);

			if ($service->price == 0) {
				if ($service->name == 'Skill Development') {
					return redirect('/skill_development/browse');
				}
			}

		}

		$country_list = Country::all();

		if(empty($country_list)){
			$country_list = [];
		}

		$data['amount'] = $amount;
		$data['country_list'] = $country_list;
		$data['page_title']='Personal and Order Data';
		$data['service']=$service;
		$data['url'] = url('service/payment/process');

		return view('front.service_payment',$data);
	}

	public function service_ckeck_code(Request $request) {
		return redirect('service/payment/'.$request->get('code'))->withInput();
	}

	public function service_payment_process_braintree(Request $request) {
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
		//$rules['company'] = 'required';
		$rules['address'] = 'required';
		$rules['country'] = 'required';
		$rules['city'] = 'required';
		$rules['zip_code'] = 'required';
		$rules['tos'] = 'required';

		if($service_price > 0) {
		//	$rules['payment_method_nonce'] = 'required';
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
		$user_profile_data['zip_code'] = $request->get('zip_code');
		$tos = $request->get('tos');
		$user_data['tos'] = 0;

		if($tos == 'on')
			$user_data['tos'] = 1;

		$user = [];

		if(Auth::check()) {
			$user_obj = Auth::user();
		} else {
			$user_obj = User::where('email', $user_data['email'])->first();
		}

		$nonceFromTheClient = $request->get("payment_method_nonce_paypal");

		if($nonceFromTheClient == null) {
			$nonceFromTheClient = $request->get("payment_method_nonce");
		}

		$service = Service::find($service_id);
		$original_amount = $service->price;
		$amount = $service->usdprice($service->currency_code,'USD',$service->price);
		$amount = $original_amount;
		$code = $request->get('code_id');
		$code_id = 0;
		$user_package= 0;
		$used_count = 0;
		$discount = 0;

		if($code != null) {
			$code_arr = $service->checkCode($code);

			if (!isset($code_arr['id']) || !isset($code_arr['amount'])) {
				$code_arr['code_error'] = 'Invalid Code';
				return $code_arr;
			}

			$code_id = $code_arr['id'];
			$code_obj = PreferentialCodes::find($code_id);
			$user_package = $code_arr['user_package'];
			$used_count = $code_arr['used_count'];
			$discount = round($code_arr['amount'], 2);

			$original_amount = $service->price - $discount;
			$original_amount = round($original_amount, 2);

			$amount = Service::usdprice($service->currency_code, 'USD', $original_amount);
			$amount = $original_amount;
		}

		$amount = round($amount, 2);
		$result = \Braintree_Transaction::sale([
			'amount' => $amount,
			'paymentMethodNonce' => $nonceFromTheClient,
			'options' => [
				'submitForSettlement' => True,
			]
		]);

		Log::info("RESULT: " . print_r($result, true));

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
				$role = UserRoles::where('user_id' , $user_obj->id)->first();

			   if($role == null) {
				   $role_arr = array('user_id' => $user_obj->id, 'role_id' => 1);
				   $ur = UserRoles::create($role_arr);
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
              if (Session::has('login_redirect')) {
                  $redirect_url = Session::get('login_redirect');
                  Session::forget('login_redirect');
              }
			   }
		   }

		   if($user_package > 0) {
			   $user_package_obj = UserPackage::where('id',$user_package)->first();
			   $user_package_obj->update([
				   'used_count' => $used_count
			   ]);
		   }

            $user_order_data = [
                'user_id' => $user_obj->id,
                'item_id' => $service_id,
                'item_name' => $service->name,
                'item_type' => 'service',
                'item_amount' => $service->price,
                'approved' => 1,
				'step_id' => -1
            ];
            $order_obj = Order::create($user_order_data);
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
               // 'payment_method_id' => 1,
                'order_status' => 1,
                'type_id' => OrderTransaction::TYPE_SERVICE,
				'created_by'=>Auth::user()->id,
				'code_id'=>$code_id
		   ];

		   $payment_method = 'Paypal';

        if(isset($result->transaction->paypal)) {
            $transaction_data['paypal_data'] = json_encode($result->transaction->paypal);
		   $transaction_data['payment_method_id'] = 2;
        } elseif(isset($result->transaction->creditCard)) {
            $transaction_data['credit_card_data'] = json_encode($result->transaction->creditCard);
			   $transaction_data['payment_method_id'] = 1;
			   $credit_card_array = json_decode($transaction_data['credit_card_data']);
			   $payment_method = isset($credit_card_array->cardType) ? $credit_card_array->cardType : "Credit Card";
			   $payment_method .= isset($credit_card_array->last4) ? '(************'.$credit_card_array->last4.')' : "";
        }

		   if(OrderTransaction::create($transaction_data)) {

			   if(isset($code_obj)) {
				   if($code_obj->is_single == PreferentialCodes::SINGLE_USAGE) {
					   $code_obj->update([
						   'is_assigned' => PreferentialCodes::ASSIGNED
					   ]);
				   }
			   }
			   $service_name = $service->name;
			   $data['order_obj'] = $order_obj;
			   $settings = Setting::find('1');
			   $data['settings'] = $settings;
			   $data['price'] =  $service->price;
			   $data['total'] =  $original_amount;
			   $data['product_name'] = $service_name;
			   $data['payment_method'] = $payment_method;
			   $data['page_title'] = 'Order Invoice';
			   $data['discount'] = $discount;
			   $data['vat_price'] = round($service->vatprice() * 22/100) ;
			   $pdf = \App::make('dompdf.wrapper');
			   //return view('client.invoice_pdf', $data);
			   $pdf->loadView('client.invoice_pdf', $data);
			   $invoice_pdf_path = base_path().'/../uploads/invoice_'.time().'.pdf';
			   $pdf->save($invoice_pdf_path);
			   //return $pdf->stream($invoice_pdf_path);
			   $mail_data = [
				   'order_id' => $order_obj->id,
				   'product_name' => $service_name,
				   'quantity' => '1',
				   'price' => $service->price,
				   'subtotal' => $service->price,
				   'total' => $original_amount,
				   'payment_method' => $payment_method,
				   'user' => $user_obj,
				   'discount' => $discount,
				   'promo_code' => $code,
				   'vat_price' => round($service->vatprice() * 22/100)
			   ];

			   \Mail::send('emails.service_activation', $mail_data, function ($m) use ($user_obj, $invoice_pdf_path) {
				   $settings=Setting::find(1);
				   $site_email = $settings->website_email;
				   $m->from($site_email, 'Wexplore');
				   $m->attach($invoice_pdf_path);
				   $m->to($user_obj->email, $user_obj->name)->subject('Service Activation!');
			   });
			   @unlink($invoice_pdf_path);

			 /*  if($service->name == 'Professional Kit') {
				   $code = SurveyCode::where('is_assigned',0)->first();
				   if($code != null) {
					   $culture_match['user_id'] = $user_obj->id;
					   $culture_match['survey_code'] = $code->survey_code;
					   $culture_match['status'] = 1;
					   $culture_match_obj = CultureMatchSurvey::create($culture_match);
					   $code->update(['is_assigned' => 1]);
				   }
			   }*/
		   }
		   return redirect('thank-you/' . $service_id);
        }

        return redirect()->back()->withInput()->with('error', 'Please fill correctly all the payment informations.');
	}

    protected function convertCurrency($amount, $from, $to){
        $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
        $data = file_get_contents($url);
        preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        return round($converted, 3);
    }

	public function service_profile(){
		$cc_code=Country::all();
		$data['countries_code'] = $cc_code;
		$data['page_title']='Service Profile';
		return view('front.service_profile',$data);
	}

	public function service_profile_save(Request $request){
		$user_id = $request['user_id'];
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
			'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user_id,
			'gender'=>'required',
			'age_range' => 'required',
			'country_origin' => 'required',
			'country_interest' => 'required',
			'education' => 'required|max:255',
			'industry' => 'required|max:255',
			'occupational_status' => 'required|max:255',
			'salary_range' => 'required',
        ]);

		//echo '<pre>';print_r($validator->fails());exit;
		if($validator->fails()) {
        	return redirect()->back()->withErrors($validator->errors());
        }


		$users['name'] = $request['name'];
		$users['surname'] = $request['surname'];
		$users['email'] = $request['email'];
		$profile_data['gender'] = $request['gender'];
		$profile_data['age_range'] = $request['age_range'];
		$profile_data['country_origin'] = $request['country_origin'];
		$profile_data['country_interest'] = $request['country_interest'];
		$profile_data['education'] =  $request['education'];
		$profile_data['industry'] = $request['industry'];
		$profile_data['occupational_status'] =  $request['occupational_status'];
		$profile_data['salary_range'] = $request['salary_range'];
		$user = User::find($user_id)->update($users);
		$user_profile = UserProfile::where('user_id',$user_id)->get();

        if($user_profile->count()>0){
            $user_profile->update($profile_data);
        }else{
            $profile_data['user_id']=$user_id;
            UserProfile::create($profile_data);
        }

		return redirect('user/dashboard')->with('status', 'Profile Saved!');
	}

    public function user_orders() {
        $user_id=Auth::user()->id;
        $orders = Order::where('user_id',$user_id)->latest()->get();
        $data['page_title']='Orders';
        $data['orders']=$orders;
        return view('front.user_order',$data);
    }

    // get user address from address_id
    public function get_address($addr_id) {
        $user_addr=UserAddress::find($addr_id);
        $user_addr_arr=array(
                        'addr_id'=>$user_addr->id,
                        'first_name'=>$user_addr->first_name,
                        'last_name'=>$user_addr->last_name,
                        'email'=>$user_addr->email,
                        'phone_number'=> $user_addr->phone_number,
                        'city'=>$user_addr->city,
                        'state'=>$user_addr->state,
                        'post_code'=>$user_addr->post_code,
                        'country'=>$user_addr->country,
                         );
        return Response::json($user_addr_arr);
    }

	public function order_invoice($id) {
		$order = Order::find($id);
		$data['order'] = $order;
		$data['page_title'] = 'Order Invoice';
		return view('front.order_invoice',$data);
	}

	public function download_order_invoice($id) {
		$order = Order::find($id);
		if($order != null) {
			$transaction = $order->transaction;
			if($transaction != null) {
				if($transaction->paypal_data != null ) {
					$payment_method = "Paypal";
				}else {
					$credit_card_array = json_decode($transaction->credit_card_data);
					$payment_method = isset($credit_card_array->cardType) ? $credit_card_array->cardType : "Credit Card";
					$payment_method .= isset($credit_card_array->last4) ? '(************' . $credit_card_array->last4 . ')' : "";
				}
			}
			$code = PreferentialCodes::find($transaction->code_id);
			$discount = 0;

			if($code != null) {
				$discount = $order->item_amount * $code->discount / 100;
			}
			$total = $order->item_amount - $discount;

			$data['page_title'] = 'Order Invoice';
			$pdf = \App::make('dompdf.wrapper');
			$data['order_obj'] = $order;
			$settings = Setting::find('1');
			$data['settings'] = $settings;
			$data['price'] =  $order->item_amount;
			$data['total'] =  $total;
			$data['product_name'] = $order->item_name;
			$data['payment_method'] = $payment_method;
			$data['page_title'] = 'Order Invoice';
			$data['discount'] = $discount;
			$data['vat_price'] = round($order->vatprice() * 22/100) ;

			$pdf->loadView('client.invoice_pdf', $data);
			//return view('client.invoice_pdf', $data);

			return $pdf->download('invoice.pdf');
			/*$pdf = \PDF::loadView('client.dream_check_lab_pdf', $data);
			return $pdf->download('invoice.pdf');*/
		}
	}

	public function checkout(Request $request) {
		$nonceFromTheClient = $request->get("payment_method_nonce");
		$result = \Braintree_Transaction::sale([
			'amount' => '10.00',
			'paymentMethodNonce' => $nonceFromTheClient,
			'options' => [
				'submitForSettlement' => True,
			]
		]);
	}
    protected function getCredentialsConsultant(Request $request)
    {
        return $request->only('email', 'password');
    }
}
