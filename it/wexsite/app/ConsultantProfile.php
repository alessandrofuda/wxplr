<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultantProfile extends Model
{
	use SoftDeletes;

	const AREA_CAREER_SESSION = 0;
	const AREA_ROLE_PLAY_INTERVIEW = 1;
	const AREA_CONTRACT_EVALUATION = 2;
	const AREA_CULTURE_SUPPORT = 3;
	const AREA_FREELANCE_SUPPORT = 4;
	const AREA_PROFESSIONAL_TROUBLESHOOTING  = 5;

	protected $dates = ['date_of_birth'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'deleted_at', 'user_id','date_of_birth','qualification','industry_expertise',
		'country_expertise','languages','vat_number','address','bank_details','oigp_company',
		'allow_personal_data','area_expertise','bio', 'experience', 'pin_number','company',
		'bank_iban','city','profile_picture'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'consultant_profile';
	
	public function user(){
		return $this->hasOne('App\User','id','user_id');
	}
	
	public function getCountryName(){
		return $this->belongsTo('App\Country','country_expertise','country_code');
	}
	
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

		if(is_numeric($id))
			return $list[$id];
		if ($id) {
			$ids = explode(',', $id);
			$return = '';
			foreach ($ids as $id) {
				$return .= $list[$id] . ',';
			}
			return rtrim($return, ',');
		}
		return $id;
	}
}
