<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DreamCheckLab extends Model
{
    const STATE_COMPLETED = 5;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',
        'user_id',
        'cv_file',
        'achievement_role_organization1',
        'achievement_problem1',
        'achievement_action1',
        'achievement_result1',
        'achievement_skills1',
        'achievement_role_organization2',
        'achievement_problem2',
        'achievement_action2',
        'achievement_result2',
        'achievement_skills2',
        'achievement_role_organization3',
        'achievement_problem3',
        'achievement_action3',
        'achievement_result3',
        'achievement_skills3',
        'your_objective',
        'motivation',
        'role_position',
        'industry',
        'company_characteristics',
        'skills_support_objective',
        'weakness_area',
        'achievable_objective',
        'fill_gap',
        'promotion_usp',
        'interest_country',
        'validate',
        'validate_by',
        'state_id',
        'validate_date',
        'form_pdf'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dream_check_lab';

    /**
     * Get the user feedback for the Dream check lab submission.
     */
    public function feedback()
    {
        return $this->hasOne('App\DreamCheckLabFeedback', 'dream_check_lab_id');
    }

    public function createUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getConsultantStatus($link = false) {

        if($this->updated_at < date("Y-m-d H:i:s", strtotime("-3 days"))) {

            if($link == true)
                return "";

                return "Expired";

        }elseif($this->feedback != null) {

            if($link == true)
                return "";

            return "Completed";

        }elseif($link == true)
            return link_to_route('dreamcheck.lab.submission.feedback','Give Feedback',['dreamcheck_id'=>$this->id]);

        return "Pending";
    }

    public function getBookingDate() {
        $consultantBooking = ConsultantBooking::where('consultant_bookings.user_id', $this->user_id)
                                            ->where('query_id', $this->id)
                                            ->where('type_id', ConsultantBooking::TYPE_INTERVIEW)
                                            ->first();

        if($consultantBooking != null) {
            if($consultantBooking->availablity != null)
             return $consultantBooking->getBookingDate();
        }
        return 'Not Booked yet';
    }

    public function getBookingStatus() {    // get status from API: 'ACTIVE' || 'INACTIVE' 
                                            // || get status from getStatusOptions: 'booked' || 'completed' || 'cancelled'
                                            // || get green button if checkdate == true !!!   <----
                                            // || return 'Not Booked yet' 

        $consultantBooking = ConsultantBooking::where('consultant_bookings.user_id', $this->user_id)
            ->where('query_id', $this->id)
            ->where('type_id', ConsultantBooking::TYPE_INTERVIEW)
            ->first();

        if($consultantBooking != null) {
            if($consultantBooking->availablity != null)
             return $consultantBooking->getMeetingStatus();
        }
        return 'Not Booked yet';
    }
}
