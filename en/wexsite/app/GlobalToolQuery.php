<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalToolQuery extends Model
{
    const STATE_PENDING = 0;
    const STATE_ASSIGNED = 1;
    const STATE_BOOKED = 2;

    const AREA_CAREER_SESSION = 0;
    const AREA_ROLE_PLAY_INTERVIEW = 1;
    const AREA_CONTRACT_EVALUATION = 2;
    const AREA_CULTURE_SUPPORT = 3;
    const AREA_FREELANCE_SUPPORT = 4;
    const AREA_PROFESSIONAL_TROUBLESHOOTING  = 5;

    protected $table = 'global_tool_query';

    protected $fillable = ['country','question_type_id','feedback_form', 'comment','user_id','consultant_id','state_id', 'attach_file', 'feedback'
        ];

    public function user(){
        return $this->hasOne('App\User','id','user_id'); 
    }

    public function consultant(){
        return $this->hasOne('App\User','id','consultant_id');   
    }

    public function getQuestionTypeOptions($id = null)
    {
        $list = [
            self::AREA_CAREER_SESSION => 'Career Session',
            self::AREA_ROLE_PLAY_INTERVIEW => 'Role Play Interview',
            self::AREA_CONTRACT_EVALUATION => 'Contract Evaluation',
            self::AREA_CULTURE_SUPPORT => 'Cultural Support',
            self::AREA_FREELANCE_SUPPORT => 'Freelance Support',
            self::AREA_PROFESSIONAL_TROUBLESHOOTING => 'Professional Troubleshooting',
        ];
        if ($id === null)
            return $list;
        if (is_numeric($id))
            return $list[$id];
        return $id;
    }

    public function getStatusOptions($id = null)
    {
        $list = [
            self::STATE_PENDING => 'Pending',
            self::STATE_ASSIGNED => 'Assigned',
            self::STATE_BOOKED => 'Booked',
        ];
        if ($id === null)
            return $list;
        if (is_numeric($id))
            return $list[$id];
        return $id;
    }

    public function getBookingDate() {
        $consultantBooking =
            ConsultantBooking::where('consultant_bookings.query_id', $this->id)
            ->where('consultant_bookings.type_id', ConsultantBooking::TYPE_QUERY)->first();

        if($consultantBooking != null) {
            if($consultantBooking->availablity != null)
              return $consultantBooking->getBookingDate();
        }
        return 'Not Booked yet';
    }

    public function getBookingStatus() {

        $consultantBooking = ConsultantBooking::where('consultant_bookings.query_id', $this->id)
            ->where('consultant_bookings.status', '!=', ConsultantBooking::STATE_CANCELLED)
            ->where('consultant_bookings.type_id', ConsultantBooking::TYPE_QUERY)
            ->first();

        if($consultantBooking != null) {
            if($consultantBooking->availablity != null)
             return $consultantBooking->getMeetingStatus();
        }
        return 'NOK';
    }

}
