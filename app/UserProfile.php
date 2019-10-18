<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserProfile extends Model {

    use SoftDeletes;

    const AREA_CAREER_SESSION = 0;
    const AREA_ROLE_PLAY_INTERVIEW = 1;
    const AREA_CONTRACT_EVALUATION = 2;
    const AREA_CULTURE_SUPPORT = 3;
    const AREA_FREELANCE_SUPPORT = 4;
    const AREA_PROFESSIONAL_TROUBLESHOOTING  = 5;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['updated_at', 'created_at'];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profile';
    
    public function getAreaExpertise() {
        return explode(',', $this->area_expertise);
    }
    
    public static function getExpertiesOptions($id = null)
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
}
