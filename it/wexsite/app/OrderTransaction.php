<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTransaction extends Model
{
    const TYPE_SERVICE = 0;
    const TYPE_VIDEO = 1;
    const TYPE_EVENT = 2;
    const TYPE_PACKAGE = 3;

    const STATE_REFUND = 2;
    const STATE_PAID = 1;
    const STATE_PENDING = 0;

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',
        'order_id',
        'transaction_id',
        'amount',
        'transaction_type',
        'payment_gateway_id',
        'payment_method_id',
        'order_status',
        'paypal_data',
        'credit_card_data',
        'type_id',
        'created_by',
        'code_id'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    public function getItemDetails() {
        $order = $this->order;

        if($order != null) {
            if($this->type_id == self::TYPE_SERVICE) {
                $service = Service::find($order->item_id);
                return $service->name;
            }

            if($this->type_id == self::TYPE_EVENT) {
                $event = Event::find($order->item_id);
                return $event->name;
            }

            if($this->type_id == self::TYPE_PACKAGE) {
                $package = Package::find($order->item_id);
                return $package->getRelatedItems();
            }

            if($this->type_id == self::TYPE_VIDEO) {
                $video = SkillDevelopmentVideos::find($order->item_id);
                return $video->video_title;
            }
        }

        return 'PRODUCT';
    }

    public function createUser(){
        return $this->belongsTo('App\User','created_by');
    }

    public function order(){
        return $this->belongsTo('App\Order','order_id');
    }

    public function video(){
        return $this->belongsTo('App\SkillDevelopmentVideos','order_id');
    }

    public function event(){
        return $this->belongsTo('App\Event','order_id');
    }

    public function package(){
        return $this->belongsTo('App\Package','order_id');
    }

    protected $table = 'transactions';

    public function getName() {
        if($this->type_id == 0 ) 
            return  $this->order->service->name ;
        elseif($this->type_id == 1) 
            return $this->order->video->video_title;
        elseif($this->type_id == 2) 
            return $this->order->event->name;
        elseif($this->type_id == 3)
            return  $this->order->package->title;
        else
            return "";
    }

    public function getTypeOptions($id =null) {
        $list = [
            self::TYPE_PACKAGE => 'Package',
            self::TYPE_SERVICE => 'Service',
            self::TYPE_VIDEO => 'Video',
            self::TYPE_EVENT => 'Event'
        ];

        if($id === null)
            return $list;

        if(is_numeric($id))
            return $list[$id];

        return $id;
    }

}
