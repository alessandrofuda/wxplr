<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoToMeeting extends Model
{
    const TYPE_MEETING = 0;
    const TYPE_WEBINAR = 1;

    protected $table = 'gotomeeting';

    protected $fillable = ['joinURL','meetingid','maxParticipants','uniqueMeetingId','conferenceCallInfo','booking_id',
        'type_id','created_at'];




    public static function saveData($data, $id, $type = null) {
        $meeting = new GoToMeeting();
        $meeting->booking_id = $id;
        $meeting->joinURL = $data['joinURL'];
        $meeting->meetingid = $data['meetingid'];
        $meeting->maxParticipants = $data['maxParticipants'];
        $meeting->uniqueMeetingId = $data['uniqueMeetingId'];
        $meeting->conferenceCallInfo = $data['conferenceCallInfo'];
        // $meeting->booking_id = $id;

        if($type == null)
            $type = self::TYPE_MEETING;
        
        $meeting->type_id = $type;

        if ($meeting->save())
            return true;

        return false;
    }

    public function booking() {
        return $this->belongsTo("App\ConsultantBooking", 'booking_id');
    }

    public static function getButtonUrl($id, $page = false) {   // return: "start meeting" || "join meeting"  ||  "" (empty string)
        
        $meeting = GoToMeeting::where('booking_id', $id)->first();

        if(isset($meeting->booking)) {

             if ($meeting->booking->checkDate(false)) {  // true/false

                if (\Auth::user()->role->role_id == 2) { // if Consultant --> 'Start Meeting' 
                    return link_to_route('consultant_start_meeting', 'Start Meeting', ['booking_id' => $id], ['id' => 'start_'.$id, 'target' => '_blank', 'class' => 'btn btn-success']);  // output: <a href="http://wexplore.test/consultant/meeting/42" target="_blank" class="btn btn-success">Start Meeting</a>
                }

                // else --> 'Join Meeting' | URL preso direttamente da tabella gotomeeting
                return link_to($meeting->joinURL, \Auth::user()->role->role_id == 2 ? 'Start' : 'Join'.' Meeting', ['id' => 'join_'.$id, 'target' => '_blank', 'class' => 'btn btn-success']);

             }
        }

        return '';
    }
}
