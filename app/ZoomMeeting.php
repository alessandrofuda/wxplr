<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\ConsultantBooking;


class ZoomMeeting extends Model
{
    const TYPE_MEETING = 0;
    const TYPE_WEBINAR = 1; 

    protected $table = 'zoom_meetings';

    protected $fillable = ['uniqueMeetingId', 'meetingid', 'host_id', 'topic', 'meeting_type', 'timezone', 'agenda', 'joinURL', 'booking_id', 'type_id', 'created_at', 'updated_at'];




    public static function saveData($data, $id, $type = null) {

        $meeting = new ZoomMeeting();
        $meeting->uniqueMeetingId = $data['uuid'];
        $meeting->meetingid = $data['id'];
        $meeting->host_id = $data['host_id'];
        $meeting->topic = $data['topic'];
        $meeting->meeting_type = $data['type']; // 1:instant  2:scheduled  3:recurring ...
        $meeting->timezone = $data['timezone'];
        $meeting->agenda = $data['agenda'];
        $meeting->joinURL = $data['join_url'];
        $meeting->booking_id = $id;

        if($type == null)
            $type = self::TYPE_MEETING;
        
        $meeting->type_id = $type;  // meeting (0) vs webinar (1)

        if ($meeting->save()) {
            return true;
        }

        return false;
    }



    public function booking() {
        return $this->belongsTo('App\ConsultantBooking', 'booking_id');
    }



    public static function getButtonUrl($id, $page = false) {   // return: "start meeting" || "join meeting"  ||  "" (empty string)
        
        $meeting = ZoomMeeting::where('booking_id', $id)->first();

        if(isset($meeting->booking)) {

             if ($meeting->booking->checkDate(false)) {  // true/false

                if (\Auth::user()->role->role_id == 2) { // if Consultant --> 'Start Meeting' 
                    return link_to_route('consultant_start_meeting', 'Start Meeting', ['booking_id' => $id], ['id' => 'start_'.$id, 'target' => '_blank', 'class' => 'btn btn-success']);  // output: <a href="http://wexplore.test/en/consultant/meeting/42" target="_blank" class="btn btn-success">Start Meeting</a>
                }

                // else --> 'Join Meeting' | URL preso direttamente da tabella zoom_meetings
                return link_to($meeting->joinURL, 'Join Meeting', ['id' => 'join_'.$id, 'target' => '_blank', 'class' => 'btn btn-success']);

             }
             // Log::info('Error: $meeting->booking->checkDate() return FALSE.');  // eliminato pechè nel loop darebbe falsi negativi
        }

        // Log::info('Error: meeting NOT found ($meeting == NULL)'); eliminato pechè nel loop darebbe falsi negativi
        return '';
    }
    

}
