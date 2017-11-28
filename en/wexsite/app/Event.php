<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'image_file',
        'created_by',
        'deleted_at',
        'consultant_id',
        'event_date',
        'event_start',
        'event_end',
        'price',
        'currency_type',
        'webinar_key',
        'joinLink',
        'memberKey'
    ];

    public function createUser(){
        return $this->hasOne('App\User','id','created_by');
    }

    public function consultant(){
        return $this->hasOne('App\User','id','consultant_id');
    }

    public function checkCode($code) {
        $code_arr = [];

        if($code != null) {
            $code = trim($code);
            $code_obj = PreferentialCodes::where('preferential_code',$code)->where('type_id',PreferentialCodes::PRODUCT_TYPE_EVENT)->where('product_id',$this->id)->first();

            if($code_obj != null) {
                $amount = $this->price * $code_obj->discount / 100;
              //  $amount = Service::usdprice($this->currency_type,'USD',$amount);

                if($code_obj->end_date >= date('Y-m-d')) {

                    if($code_obj->is_single == 1) {

                        $transaction = OrderTransaction::where('code_id',$code_obj->id)->first();

                        if($transaction == null) {
                            $code_arr['id'] = $code_obj->id;
                            $code_arr['amount'] = $amount;
                            return $code_arr;
                        }

                    }else {
                        $ok = true;

                        if(Auth::check()) {
                            $transaction = OrderTransaction::where('code_id',$code_obj->id)->where('user_id',Auth::user()->id)->first();

                            if($transaction != null)
                                $ok = false;

                        }

                        if($ok == true) {
                            $code_arr['id'] = $code_obj->id;
                            $code_arr['amount'] = $amount;
                        }

                        return $code_arr;
                    }

                }

            }

        }

        return $code_arr;
    }

    public function vatprice($only = false) {
        $price = $this->price;
        $p = $price / 1.22;
        $p =  round($p);
        return $p;
    }

    public function alreadyBooked() {

        if(Auth::check()) {
            $booking = EventBooking::where('user_id', Auth::user()->id)->where('event_id', $this->id)->first();

            if ($booking != null)
                return true;

        }

        return false;
    }

    public function getBookingCount() {
        return EventBooking::where('event_id',$this->id)->count();
    }

    public function bookings() {
        return $this->hasMany('App\EventBooking', 'event_id');
    }

    public function updateWebinar() {
        $token = ConsultantBooking::getWebinarAccessToken();
        $key = ConsultantBooking::getWebinarAccessToken(false);

        $start_time = $this->event_date.'T'.$this->event_start.'Z';
        $end_time = $this->event_date.'T'.$this->event_end.'Z';


        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: OAuth oauth_token='.$token
        ];

        $postData = json_encode([
            "subject" =>  trim($this->name),
            "description" => trim($this->description),
            "times" => [[
                'startTime' => $start_time,
                'endTime' => $end_time
            ]],
            'timeZone' => 'UTC',
            'type' => 'single_session',
            'isPasswordProtected' => false
        ]);

        $url = "https://api.getgo.com/G2W/rest/organizers/".$key."/webinars/".$this->webinar_key;

        $out = ConsultantBooking::curl_request('PUT', $headers, $url, $postData);


        if(isset($out['webinarKey'])) {
            $this->update(
                [
                    'webinar_key' => $out['webinarKey']
                ]
            );

            if($this->memberKey == null) {
                $this->addCoOrganizer();
            }
            return true;
        }

        return false;
    }

    public function addWebinar() {
        $token = ConsultantBooking::getWebinarAccessToken();
        $key = ConsultantBooking::getWebinarAccessToken(false);

        $start_time = $this->event_date.'T'.$this->event_start.'Z';
        $end_time = $this->event_date.'T'.$this->event_end.'Z';

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: OAuth oauth_token='.$token
        ];

        $postData = json_encode([
            "subject" =>  trim($this->name),
            "description" => trim($this->description),
            "times" => [[
                    'startTime' => $start_time,
                    'endTime' => $end_time
                ]],
        'timeZone' => 'UTC',
        'type' => 'single_session',
        'isPasswordProtected' => false
        ]);

        $url = "https://api.getgo.com/G2W/rest/organizers/".$key."/webinars";

        $out = ConsultantBooking::curl_request('POST', $headers, $url, $postData);
        Setting::dump($out);
        if(isset($out['webinarKey'])) {
            $this->update(
                [
                    'webinar_key' => $out['webinarKey']
                ]
            );
            return true;
        }

        return false;
    }

    public function addCoOrganizer() {
        $user = User::find($this->consultant_id);

        if($user) {
            $token = ConsultantBooking::getWebinarAccessToken();
            $key = ConsultantBooking::getWebinarAccessToken(false);

            $headers = [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: OAuth oauth_token=' . $token
            ];
            $postData = json_encode([[
                "external" => true,
                "organizerKey" => $key,
                'givenName' => $user->name,
                'email' => $user->email,
            ]]);

            $url = "https://api.getgo.com/G2W/rest/organizers/" . $key . "/webinars/" . $this->webinar_key . "/coorganizers";

            $out = ConsultantBooking::curl_request('POST', $headers, $url, $postData);


            if (isset($out[0]['memberKey']) && isset($out[0]['joinLink'])) {
                $this->update([
                    'joinLink' => $out[0]['joinLink'],
                    'memberKey' => $out[0]['memberKey']
                ]);
                return true;
            }
        }
        return false;
    }

    public function cancelWebinar() {
        $token = ConsultantBooking::getWebinarAccessToken();
        $key = ConsultantBooking::getWebinarAccessToken(false);

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: OAuth oauth_token='.$token
        ];

        $url = "https://api.getgo.com/G2W/rest/organizers/'.$key.'/webinars/".$this->webinar_key;

        $out = ConsultantBooking::curl_request('DELETE', $headers, $url);
        return false;
    }

    public function getJoinUrl() {
        $booking = EventBooking::where('event_id', $this->id)->where('user_id', \Auth::user()->id)->first();

        if($booking != null) {
          return link_to($booking->joinUrl, 'Join Event/Webinar',['class'=>'service_btn']);
        }

        return '';
    }

    public function getDate($type = ConsultantAvailablity::DATE) {
        $date = date('Y-m-d',strtotime($this->event_date));
        $date_time = date('Y-m-d H:i:s',strtotime($date.' '.$this->event_start));

        if($type == ConsultantAvailablity::START_TIME) {
            $date_time = Setting::getDateTime($date_time);
            return date('H:i:s',strtotime($date_time));
        }elseif ($type == ConsultantAvailablity::END_TIME) {
            $date_time = date('Y-m-d H:i:s',strtotime($date.' '.$this->event_end));
            $date_time = Setting::getDateTime($date_time);
            return date('H:i:s', strtotime($date_time));
        }

        return Setting::getDateTime($date_time, false);
    }
   
}
