<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\ConsultantBooking;


class ZoomApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSaveMeeting() {	
    	//POST
    	$headers = ConsultantBooking::getZoomApiHeaders();
    	$url = ConsultantBooking::getZoomApiBaseUrl() .'/users/'.ConsultantBooking::getZoomApiUserId().'/meetings';
    	$start_date = '2018-07-14T12:30:00Z';
    	$postData = json_encode([
            "topic" => "Consultant Meeting",
            "type"  => 2, // 1  // 1:instant  2:scheduled  3:recurring ... (in gotomeeting era: 1)
            "start_time" => $start_date,  // always use GMT time
            "duration" => 180,
            "agenda" => "Free Call"
        ]);
        // API call !!
        $out = ConsultantBooking::curl_request("POST", $headers, $url, $postData);
        
        
        $this->assertTrue( isset($out['uuid']) && $out['uuid'] !== null );


        $meetingId = $out['id'];        
        return $meetingId;
    }


    public function testUpdateMeeting() {

    	// 
    }


    public function testCancelMeeting() {

    	$headers = ConsultantBooking::getZoomApiHeaders();
        $meetingId = $this->testSaveMeeting();
        $url = ConsultantBooking::getZoomApiBaseUrl().'/meetings/'.$meetingId;
        
        $out = ConsultantBooking::curl_request('DELETE', $headers, $url);  // 1- delete from Zoom platform
        dd($out);
    	
    }
}
