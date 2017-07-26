<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultantServices extends Model
{

    const SERVICE_PROFESSIONAL_KIT = 0;
    const SERVICE_ROLE_PLAY_INTERVIEW = 1;
    const SERVICE_CONTRACT_EVALUATION = 2;
    const GT_CULTURE_SUPPORT = 3;
    const SERVICE_GT_FREELANCE_SUPPORT = 4;
    const SERVICE_GT_PROFESSIONAL = 5;

    const SERVICE_GLOBAL_TOOL_BOX = 6;
    const SERVICE_LIVE_WEBINAR = 7;

    const STATE_INACTIVE = 0;
    const STATE_ACTIVE = 1;

    protected $fillable = [
        'service_id', 'user_id','state_id'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consultant_services';

    public function consultant() {
        return $this->belongsTo('App\User','user_id');
    }

    public function getStatusOptions($id = null) {
        $list = [
            self::STATE_ACTIVE => 'Allowed',
            self::STATE_INACTIVE => 'Not Allowed'
        ];

        if($id === null) {
            return $list;
        }

        if(is_numeric($id)) {
            return $list[$id];
        }

        return $id;
    }

    public static  function getServiceName($id = null) {
        $list = [
            self::SERVICE_GLOBAL_TOOL_BOX => 'Global Tool Box',
            self::SERVICE_PROFESSIONAL_KIT => 'Professional',
            self::SERVICE_CONTRACT_EVALUATION => 'Professional',
            self::SERVICE_GT_FREELANCE_SUPPORT => 'Professional',
            self::SERVICE_GT_PROFESSIONAL => 'Professional',
            self::SERVICE_LIVE_WEBINAR => 'Professional',
            self::SERVICE_ROLE_PLAY_INTERVIEW => 'Professional',
        ];

        if($id === null) {
            return $list;
        }

        if(is_numeric($id)) {
            return $list[$id];
        }

        return $id;
    }
}
