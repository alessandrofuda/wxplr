<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    const SKILL_PROFESSIONAL_KIT = 1;
    const SKILL_GLOBAL_TOOL_BOX = 2;
    const SKILL_VIDEOS = 3;
    const SKILL_WEBINAR = 4;
    const SKILL_DEVELOPMENT_PACKAGE = 5;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description','skills', 'count', 'price', 'currency_type', 'state_id', 'type_id', 'created_by','created_at','updated_at','deleted_at','items'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';

    public function getSkillOptions($id = null) {
        $list = [
                self::SKILL_PROFESSIONAL_KIT => 'Professional Kit',
                self::SKILL_GLOBAL_TOOL_BOX => 'Global Tool Box',
                self::SKILL_VIDEOS => 'Skill Developement Videos',
                self::SKILL_WEBINAR => 'Live Webinars'
        ];
        if($id === null) {
            return $list;
        }
        if(is_numeric($id))
            return $list[$id];
        return $id;
    }
    public function getRelatedItems() {
        $skills = explode('-',$this->skills);
        $items = '';
        if($this->items != null) {
            $item_arr = explode('-', $this->items);
            $skill_item_arr = array_combine($skills, $item_arr);
            foreach ($skill_item_arr as $skill => $item) {
                if ($skill == Package::SKILL_VIDEOS) {
                    $item_id_arr = explode(',', $item);
                    $videos = SkillDevelopmentVideos::whereIn('id', $item_id_arr)->get();
                    if (count($videos) > 0 ) {
                        $items .= 'Video: ';
                        foreach ($videos as $video) {
                            $items .= link_to_route('video_view',$video->video_title,[
                                    'video_id'=>$video->id
                                ]) . ', ';
                        }
                        $items = rtrim($items,', ');
                        $items .= '<br/>';
                    }
                }
                if ($skill == Package::SKILL_WEBINAR) {
                    $item_id_arr = explode(',', $item);
                    $events = Event::whereIn('id', $item_id_arr)->get();
                    if (count($events) > 0 ) {
                        $items .= 'Event/ Webinar: ';
                        foreach ($events as $event) {
                            $items .= $event->name.'@'.$event->event_date . ', ';
                        }
                        $items = rtrim($items,', ');
                        $items .= '.<br/>';
                    }
                }
            }
        }
        return rtrim($items,', ');
    }
    public function checkCode($code) {
        $code_arr = [];
        if($code != null) {
            $code = trim($code);
            $code_obj = PreferentialCodes::where('preferential_code',$code)->where('type_id',PreferentialCodes::PRODUCT_TYPE_PACKAGE)->where('product_id',$this->id)->first();
            if($code_obj != null) {
                $amount = $this->price * $code_obj->discount / 100;
                //  $amount = Service::usdprice($this->currency_type,'USD',$amount);
                if($code_obj->end_date > date('Y-m-d')) {
                    if($code_obj->is_single == 1) {
                        $transaction = OrderTransaction::where('code_id',$code_obj->id)->first();
                        if($transaction == null) {
                            $code_arr['id'] = $code_obj->id;
                            $code_arr['amount'] = $amount;
                            return $code_arr;
                        }
                    }else {
                        $ok = true;
                        if(Auth::check()) {
                            $transaction = OrderTransaction::where('code_id',$code_obj->id)->where('user_id',Auth::user()->id)->first();
                            if($transaction != null)
                                $ok = false;
                        }
                        if($ok == true) {
                            $code_arr['id'] = $code_obj->id;
                            $code_arr['amount'] = $amount;
                        }
                        return $code_arr;
                    }
                }
            }
        }
        return $code_arr;
    }
    public function vatprice($only = false) {
        $price = $this->price;
        $p = $price / 1.22;
        $p =  round($p);
        return $p;
    }
}
