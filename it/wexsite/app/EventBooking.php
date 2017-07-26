<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventBooking extends Model
{
    use SoftDeletes;

    protected $table = 'event_bookings';

    protected $fillable = [
        'event_id',
        'transaction_id',
        'user_id',
        'deleted_at',
        'created_at',
        'registrantKey',
        'joinUrl'
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function transaction(){
        return $this->hasOne('App\OrderTransaction','id','transaction_id');
    }

    public function event(){
        return $this->hasOne('App\Event','id','event_id');
    }

    public function registerWebinar() {
        $user = User::find($this->user_id);
        $token = ConsultantBooking::getWebinarAccessToken();
        $key = ConsultantBooking::getWebinarAccessToken(false);
        $webinar = $this->event->webinar_key;

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: OAuth oauth_token='.$token
        ];

        $url = "https://api.citrixonline.com/G2W/rest/organizers/".$key."/webinars/".$webinar."/registrants";

        $postData = json_encode([
            "firstName" => $user->name,
            "lastName" => $user->surname,
            "email" =>  $user->email,
            "source" => "",
            "address" => isset($user->userProfile->address) ? $user->userProfile->address : "",
            "city" =>  isset($user->userProfile->city) ? $user->userProfile->city : "",
            "state" => isset($user->userProfile->state) ? $user->userProfile->state : "",
            "zipCode" => isset($user->userProfile->zip_code) ? $user->userProfile->zip_code : "",
            "country" => isset($user->userProfile->country) ? $user->userProfile->country : "",
            "phone" => isset($user->userProfile->telephone) ? $user->userProfile->telephone : "",
            "organization" => isset($user->userProfile->company) ? $user->userProfile->company : "",
            "jobTitle" => isset($user->userProfile->occupation) ? $user->userProfile->occupation : "",
            "questionsAndComments" => "",
            "industry" => isset($user->userProfile->industry) ? $user->userProfile->industry : "",
            "numberOfEmployees" => "",
            "purchasingTimeFrame" => "",
            "purchasingRole" => "",
            "responses" => [ [
                "questionKey" =>  0,
      "responseText" => "string",
      "answerKey" => 0
        ]]
        ]);

        $out = ConsultantBooking::curl_request('POST', $headers, $url, $postData);

        if(isset($out['registrantKey']) && isset($out['status']) && isset($out['joinUrl'])) {

            if($out['status'] == 'APPROVED') {
                $this->update([
                    'registrantKey' => $out['registrantKey'],
                    'joinUrl' => $out['joinUrl']
                ]);
                return true;
            }

        }

        return false;
    }

    public function removeRegistrant() {
        $token = ConsultantBooking::getWebinarAccessToken();
        $key = ConsultantBooking::getWebinarAccessToken(false);
        $webinar = $this->event->webinar_key;

        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: OAuth oauth_token='.$token
        ];

        $url = "https://api.citrixonline.com/G2W/rest/organizers/".$key."/webinars/".$webinar."/registrants/".$this->registrantKey;

        $out = ConsultantBooking::curl_request('DELETE', $headers, $url);

    }
}
