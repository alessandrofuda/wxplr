<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreferentialCodes extends Model
{
    const  PRODUCT_TYPE_SERVICE = 0;
    const  PRODUCT_TYPE_VIDEO = 1;
    const  PRODUCT_TYPE_EVENT = 2;
    const PRODUCT_TYPE_PACKAGE = 3;
    const PRODUCT_TYPE_USER_PACKAGE = 4;

    const SINGLE_USAGE = 0;
    const MULTIPLE_USAGE = 1;

    const ASSIGNED = 1;
    use SoftDeletes;
    protected $fillable = [
        'deleted_at', 'label','preferential_code','is_assigned','type_id', 'product_id', 'discount', 'is_single', 'end_date'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'preferential_codes';
    public static function getTypeOptions($id = null) {
        $list = [
            self::PRODUCT_TYPE_SERVICE => 'Service',
            self::PRODUCT_TYPE_VIDEO => 'Video'
        ];
        if($id === null) {
            return $list;
        }
        if(is_numeric($id)) {
            if(isset($list[$id]))
                return $list[$id];
        }
        return $id;
    }
    public function productSelected() {
        if($this->type_id == self::PRODUCT_TYPE_SERVICE) {
            $product = Service::where('id',$this->product_id)->first();
            if($product)
                return $product->name;
        }else{
            $product = SkillDevelopmentVideos::where('id',$this->product_id)->first();
            if($product)
             return $product->video_title;
        }
        return '';
    }
    public function getUsageOptions() {
        if($this->is_single == 1)
            return 'Multiple Times';
        return 'Only Once';
    }
    public function transactions() {
        return $this->hasMany('App\OrderTransaction','code_id');
    }
}
