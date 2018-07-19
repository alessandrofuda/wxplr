<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\ConsultantBooking;
use App\ZoomMeeting;
use Carbon\Carbon;


class ZoomApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSaveMeeting() {	
    	//POST
    	$type = 9; // 9='Phpunit test'
    	$headers = ConsultantBooking::getZoomApiHeaders();
    	$url = ConsultantBooking::getZoomApiBaseUrl() .'/users/'.ConsultantBooking::getZoomApiUserId().'/meetings';
    	$start_date = '2018-07-20T12:30:00Z';
    	$postData = json_encode([
            "topic" => "Consultant Meeting - Automatic Unit Test",
            "type"  => 2, // 1  // 1:instant  2:scheduled  3:recurring ... (in gotomeeting era: 1)
            "start_time" => $start_date,  // always use GMT time
            "duration" => 180,
            "agenda" => "Free Call"
        ]);
        
        $out = ConsultantBooking::curl_request("POST", $headers, $url, $postData);  // API call

        $test_API = false;
        $test_Insert_in_DB = false;

        if (isset($out['uuid']) && $out['uuid'] !== NULL ) {
            
            $test_API = true;

            if( ZoomMeeting::saveData($out, 999999, $type) ){  // insert in DB
            	$test_Insert_in_DB = true;
            }
            
        }

        $this->assertTrue( $test_API );
        $this->assertTrue( $test_Insert_in_DB);

    }



    public function testUpdateMeeting() {

    	// 
    }



    public function testCancelMeeting() {

    	$headers = ConsultantBooking::getZoomApiHeaders();
        $zoommeeting = ZoomMeeting::where('type_id', 9)
        						  ->whereDate('created_at', '=', Carbon::today())
        						  ->get(['meetingid'])
        						  ->last();
        $meetingId = $zoommeeting->meetingid;

        dump($meetingId);
	    
	    $url = ConsultantBooking::getZoomApiBaseUrl().'/meetings/'.$meetingId;
        
        $test_API_delete_from_Zoom = false;
        $test_delete_from_DB = false;


        $out = ConsultantBooking::curl_request('DELETE', $headers, $url);  // 1- delete from Zoom platform


        if(!isset($out['code']) || $out === null) {  // response 204 No Content --> OK! deleted correctly
        	$test_API_delete_from_Zoom = true;
        }

        if ($zoommeeting->delete()) {  // 2- delete from DB
        	dump('ok1');
                $test_delete_from_DB = true;
            dump('ok2');
            }

dump('ok3');
        $this->assertTrue( $test_API_delete_from_Zoom );
dump('ok4');
        $this->assertTrue( $test_delete_from_DB );
dump('ok5');

        // 	VERIFICARE CORRETTA CANCELLAZIONE DAL DB
        
    }



}
