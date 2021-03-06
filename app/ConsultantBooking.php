<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Echo_;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTFactory;



class ConsultantBooking extends Model
{
    use SoftDeletes;

    const TYPE_INTERVIEW = 0;
    const TYPE_QUERY = 1;

    const STATE_PENDING = 0;
    const STATE_COMPLETED = 1;
    const STATE_CANCELLED = 2;



    protected $table = 'consultant_bookings';
    protected $fillable = ['deleted_at','user_id','availablity_id','status','feedback_comments', 'is_sent', 'query_id', 'type_id', 'state_id', 'recording'];



    
    public function availablity(){
        return $this->belongsTo('App\ConsultantAvailablity','availablity_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public static function getZoomApiBaseUrl() {
        $API_base_url = 'https://api.zoom.us/v2';
        return $API_base_url;
    }

    public static function getZoomApiHeaders(){
        $ZoomAccessToken = self::getZoomAccessToken();
        $headers = [
                    'Content-Type: application/json',
                    'Accept: application/json, application/xml',
                    'Authorization: Bearer ' . $ZoomAccessToken 
                    ];
        return $headers;
    }

    public static function getZoomApiUserId(){
        $zoomUserId = env('ZOOM_USER_ID');
        return $zoomUserId;
    }

    public static function getTypeOptions($id = null, $qid = null) {
        $list = [
            self::TYPE_INTERVIEW => 'Career Orientation Session',
            self::TYPE_QUERY => 'Global tool Query'
        ];

        if($id === null)
            return $list;

        if(is_numeric($id)) {

            if($id == self::TYPE_INTERVIEW)
                return $list[$id];
            else {
                $query = GlobalToolQuery::find($qid);
                $type = 'Global Tool Query';

                if($query != null)  {
                    $type .= ' ('.$query->getQuestionTypeOptions($query->question_type_id).')';
                }

                return $type;
            }

        }

        return $id;
    }

    public static function getStatusOptions($id = null) {   // booked | completed | cancelled
        $list = [
            self::STATE_PENDING => 'Booked',        // 0
            self::STATE_COMPLETED => 'Completed',   // 1
            self::STATE_CANCELLED => 'Cancelled'    // 2
        ];

        if($id === null) {
            return $list;
        }

        if(is_numeric($id)) {
            return $list[$id]; 
        }

        return $id;
    }


    public function zoommeeting() {
        return $this->hasOne('App\ZoomMeeting', 'booking_id');
    }


    public function saveMeeting($type = null) {
        
        $headers = self::getZoomApiHeaders();   
        $url = self::getZoomApiBaseUrl() .'/users/'.self::getZoomApiUserId().'/meetings';
        
        $start_date = date('Y-m-d', $this->availablity->available_date) . 'T' . $this->availablity->available_start_time . ':00Z'; 
        // $end_date = date('Y-m-d', $this->availablity->available_date) . 'T' . $this->availablity->available_end_time . ':00Z';
            // TESTING
            //$start_date = '2018-07-18T12:30:00Z';
        $postData = json_encode([
            "topic" => "Consultant Meeting",
            "type"  => 2, // 1  // 1:instant  2:scheduled  3:recurring ... (in gotomeeting era: 1)
            "start_time" => $start_date,  // always use GMT time
            "duration" => 180,
            "agenda" => "Free Call"
        ]);
        
        // API call !!
        $out = self::curl_request("POST", $headers, $url, $postData);

        if(is_array($out) && !array_key_exists('uuid', $out)){
            //dump('Error: \'uuid\' meeting not created from Zoom API call. Response from Zoom API: ');
            //dd($out);
            return $out;
        }
        
        if (isset($out) && $out !== NULL ) {
            if($type == null) {
                $type = ZoomMeeting::TYPE_MEETING;  // 0
            }

            if (ZoomMeeting::saveData($out, $this->id, $type)){
                return true;
            }
            
        }

        return false;
    }



    public function updateMeeting() { 

        // TEST
        // $this->zoommeeting = (object) ['meetingid' => 10];

        if($this->zoommeeting == null) {

            $this->saveMeeting();

        } else {

            $headers = self::getZoomApiHeaders();
            $meetingId = $this->zoommeeting->meetingid;
            $url = self::getZoomApiBaseUrl().'/meetings/'.$meetingId;
            $start_date = date('Y-m-d', $this->availablity->available_date) . 'T' . $this->availablity->available_start_time . ':00Z';
            //$end_date = date('Y-m-d', $this->availablity->available_date) . 'T' . $this->availablity->available_end_time . ':00Z';
                // TESTING
                // $start_date = '2088-01-01T12:30:00Z';
                // $end_date = '2088-01-01T14:45:00Z';
            $postData = json_encode([  // SISTEMARE !!
                "topic" => "Consultant Meeting",
                "type" => 2,  // 1
                "start_time" => $start_date, // always use GMT time
                "duration" => 180,
                "agenda" => "Free Call - updated"
            ]);
            
            $out = self::curl_request("PATCH", $headers, $url, $postData);

        }
    
        return true;
    }


    
    public function getMeetingStatus() {  

        $meeting_link = ZoomMeeting::getButtonUrl($this->id);
            
        if ($meeting_link != '') {
            return $meeting_link;  // ---> !! "START/JOIN MEETING" button !!
        } 

        $booking_status_value = $this->status;  // 0,1,2
        $status = self::getStatusOptions($booking_status_value);
        
        return $status;     // 'booked' || 'completed' || 'cancelled'

    }



    public function cancelMeeting() {  

        // TEST
        // $this->zoommeeting = (object) ['meetingid' => 10];
        $zoommeeting = $this->zoommeeting;
        
        if($zoommeeting != null) {
            
            $headers = self::getZoomApiHeaders();
            $meetingId = $zoommeeting->meetingid;  
            $url = self::getZoomApiBaseUrl().'/meetings/'.$meetingId;
            $out = self::curl_request('DELETE', $headers, $url);  // 1- delete from Zoom platform

            if ($zoommeeting->delete()) {  // 2- delete from DB
                return true;
            }

        }

        return false;
    }


    public function start_meeting() {

        $zoommeeting = $this->zoommeeting;

        if($zoommeeting != null ) {
            
            $meetingId = $zoommeeting->meetingid;
            $url = self::getZoomApiBaseUrl().'/meetings/'. $meetingId;
            $out = self::curl_request('GET', self::getZoomApiHeaders(), $url);  

            if( isset($out['start_url']) ) {
                $start_meeting_url = $out['start_url'];
                return $start_meeting_url;  // OK !
            } 

            Log::info('Error from Zoom API Call. ErrCode '.$out['code']. ', errMessage: '.$out['message']);
            return false; //'Message from Zoom API Call. Error '.$out['code']. ': '.$out['message']; //false;
            
        }

        Log::info('Error: zoommeeting == null and not found in ConsultantBooking model.');
        return false;
    }

    /* public static function getAccessToken($token = true)
    {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
        ];

        $email = env('GOTOMEETING_USER_ID');
        $password = env('GOTOMEETING_PASSWORD');
        $client_id = env('GOTOMEETING_CONSUMER_KEY');

        $postData = "grant_type=password&user_id=".$email."&password=".$password."&client_id=".$client_id;
        $url = "https://api.getgo.com/oauth/access_token";
        $out = self::curl_request('POST', $headers, $url, $postData);
        if($token == true) {

            if (isset($out['access_token'])) {
                return $out['access_token'];
            }

        }else{

            if(isset($out['organizer_key'])) {
                return $out['organizer_key'];
            }

        }

        return '';
    }
    */







    

    public static function getZoomAccessToken()    // verify to https://jwt.io
    {
        //Zoom API credentials from https://developer.zoom.us/me/
        $customClaims = [
                            'iss'   => env('ZOOM_API_KEY'),
                            'exp'   => time() + 3600,   // seconds!
                            'nbf'   => time() - 250, // PER COMPENSARE LO SFASAMENTO ORARIO SERVER in PRODUZIONE DI CIRCA 30 SECONDI (aumenta!)!! 
                            // 'iat'   => null,
                            // 'sub'   => null,
                            // 'jti'   => null
                        ];

        $payload = JWTFactory::make($customClaims); // $factory->make();

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::encode($payload) ) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return $token;
    }









    /*
    public static function getWebinarAccessToken($token = true)
    {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
        ];

        $email = env('GOTOMEETING_USER_ID');
        $password = env('GOTOMEETING_PASSWORD');
        $client_id = env('GOTOWEBINAR_CONSUMER_KEY');

        $postData = "grant_type=password&user_id=".$email."&password=".$password."&client_id=".$client_id;
        // $url = "https://api.getgo.com/oauth/access_token";
        $url = self::getZoomApiBaseUrl().'/............................................';

        $out = self::curl_request('POST', $headers, $url, $postData);

        if($token == true) {

            if (isset($out['access_token'])) {
                return $out['access_token'];
            }

        }else{

            if(isset($out['organizer_key'])) {
                return $out['organizer_key'];
            }

        }

        return '';
    } 
    */


    public function getBookingDate() {
        $date = date('Y-m-d', strtotime($this->availablity->getDate(\App\ConsultantAvailablity::DATE)));  
        $start_time = date('H:i:s', strtotime($this->availablity->getDate(\App\ConsultantAvailablity::START_TIME)));
        $end_time = date('H:i:s', strtotime($this->availablity->getDate(\App\ConsultantAvailablity::END_TIME)));
        
        return 'On '.$date.' starts at '.$start_time.' ends at '. $end_time;
    }

    public function getBookingType() {

        if($this->type_id == ConsultantBooking::TYPE_INTERVIEW)
            return "Interview";

        if($this->type_id == ConsultantBooking::TYPE_QUERY) {
            $query = GlobalToolQuery::find($this->query_id);

            if($query != null) {
                return $query->getQuestionTypeOptions($query->question_type_id);
            }

            return "Query";
        }

        return $this->availablity->title;
    }

    public function checkDate($end = true)  // true/false
    {

        $start_date = date('Y-m-d', $this->availablity->available_date) . ' ' . $this->availablity->available_start_time;
        $end_date = date('Y-m-d', $this->availablity->available_date) . ' ' . $this->availablity->available_end_time ;
        $now = date('Y-m-d H:i:s');  // UTC


        $start_date = strtotime(date('Y-m-d H:i:s',strtotime($start_date ."-15 minutes")));
        $end_date = strtotime($end_date);
        $now = strtotime($now);

        if ($end == true) {
            if ($now < $end_date) {
                return true;
            }

        }else {
           if ($now < $end_date && $now >= $start_date) {  // check che fa comparire "Start Meeting" button.
               return true;
           }
        }

        return false;
    }

    public function getUploadForm() {
        $data = '';

        if($this->recording != null) {
            $data = " <span id='message_".$this->id."'><i class='fa fa-check'></i> Recording Uploaded</span>";
        }else {
            $data = " <span id='message_".$this->id."'></span>";
            $data .= "<form method='POST' action='" . url('consultant/meeting/' . $this->id . '/recording/upload') . "' id='form_" . $this->id . "'>" . csrf_field() . "<input required type='file' name='upload_file' id='file_" . $this->id . "'><div id='file_error_" . $this->id . "'></div></form>
        <a  id='upload_file" . $this->id . "' class='btn btn-success'>Upload Recording</a>";
        }

        return $data;
    }


    public static function curl_request($type, $headers, $url, $postData = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if($type == 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        }

        if($type == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }


        if($type == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        if($type == 'PATCH') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }


        if($type == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $output = curl_exec($ch);
        $out = json_decode($output, true);  // true--> convert from object to associative array

        curl_close($ch);

        return $out;
    }

}
