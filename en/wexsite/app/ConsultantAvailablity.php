<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ConsultantAvailablity extends Model
{
	use SoftDeletes;

	const AREA_CAREER_SESSION = 0;
	const AREA_ROLE_PLAY_INTERVIEW = 1;
	const AREA_CONTRACT_EVALUATION = 2;
	const AREA_CULTURE_SUPPORT = 3;
	const AREA_FREELANCE_SUPPORT = 4;
	const AREA_PROFESSIONAL_TROUBLESHOOTING  = 5;

	const STATUS_PENDING = 0;
	const STATUS_BOOKED = 1;


	const DATE = 0;
	const START_TIME = 1;
	const END_TIME = 2;

	protected $table = 'consultant_availablities';

    protected $fillable = ['deleted_at', 'consultant_id','title','available_date','available_start_time',
		'available_end_time','status', 'type_id', 'is_booked' ];
	
	public function consultant(){
		return $this->hasOne('App\User','id','consultant_id');
	}

	public static function getTypeOptions($id = null) {
		$consultant = Auth::user();
		$areas_key = explode(',',$consultant->consultantProfile->area_expertise );
		$areas_value = explode( ',',$consultant->consultantProfile->getExpertiesOptions($consultant->consultantProfile->area_expertise));
		$final_list = array_combine($areas_key, $areas_value);
		
		if($id === null)
			return $final_list;

		if(is_numeric($id))
			return $final_list[$id];

		return $id;
	}

	public function getDate($type = self::DATE) {
		$date = date('Y-m-d',$this->available_date);
		$date_time = date('Y-m-d h:i a',strtotime($date.' '.$this->available_start_time));

		if($type == self::START_TIME) {

			$date_time = Setting::getDateTime($date_time);  
			return date('H:i:s',strtotime($date_time));

		}elseif ($type == self::END_TIME) {

			$date_time = date('Y-m-d h:i a',strtotime($date.' '.$this->available_end_time));
			$date_time = Setting::getDateTime($date_time);
			return date('H:i:s', strtotime($date_time));
		}

		return Setting::getDateTime($date_time, false);
	}

	public static function getAvailabilityType($key = null){

		$availability_type = [
			0 =>'Career Session',
			1 =>'Role Play Interview',
			2 =>'Contract Evaluation',
			3 =>'Cultural Support',
			4 =>'Freelance Support',
			5 =>'Professional Troubleshooting',			
		];
		
		return $availability_type[$key];

	}

}
