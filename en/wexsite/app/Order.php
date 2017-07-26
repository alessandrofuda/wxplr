<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'user_id','user_address_id', 'item_id', 'item_name', 'item_type', 'item_amount', 'comment', 'approved','step_id'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    public function service(){
        return $this->belongsTo('App\Service','item_id');
    }

    public function video(){
        return $this->belongsTo('App\SkillDevelopmentVideos','item_id');
    }

    public function event(){
        return $this->belongsTo('App\Event','item_id');
    }

    public function package(){
        return $this->belongsTo('App\Package','item_id');
    }

    public function transaction(){
        return $this->hasOne('App\OrderTransaction','order_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function getKitStatus($id, $status = false) {
        if($id == 1) {
            $class = '';
            $step = link_to_route('professional.kit','Proceed',[], ['class'=>'btn btn-info']);
            if ($this->step_id > 0) {
                $class = 'active';
                $step = '<span class=""><i class="fa fa-check"></i> Done</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . link_to_route('professional.kit', 'View', [], ['class' => 'btn btn-info']);
            }
        }

        if($id == 2) {
            $class = '';
            $step = 'Pending';
            if ($this->step_id > 0)
              $step = link_to_route('market_analysis', 'Proceed', [], ['class' => 'btn btn-info']);
            if ($this->step_id > 1) {
                $class = 'active';
                $step = '<span class=""><i class="fa fa-check"></i> Done</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . link_to_route('market_analysis', 'View', [], ['class' => 'btn btn-info']);
            }
        }

        if($id == 3) {
            $class = '';
            $step = 'Pending';
            if ($this->step_id > 1)
                $step = link_to_route('culture_match', 'Proceed', [], ['class' => 'btn btn-info']);
            if ($this->step_id > 2) {
                $class = 'active';
                $step = '<span class=""><i class="fa fa-check"></i> Done</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . link_to_route('user.mydocuments', 'View', [], ['class' => 'btn btn-info']);
            }
        }

        if($id == 4) {
            $class = '';
            $step = 'Pending';
            if ($this->step_id > 2)
             $step = link_to_route('dream.check.lab', 'Proceed', [], ['class' => 'btn btn-info']);
            if ($this->step_id > 3) {
                $class = 'active';
                $step = '<span class=""><i class="fa fa-check"></i> Done</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . link_to_route('user.mydocuments', 'View', [], ['class' => 'btn btn-info']);
            }
        }


        if($id == 5) {
            $class = '';
            $step = 'Pending';
            if ($this->step_id > 4) {
                $class = 'active';
                $step = '<span class=""><i class="fa fa-check"></i> Done</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . link_to_route('market_analysis', 'View', [], ['class' => 'btn btn-info']);
            }
        }

        if($id == 6) {
            $class = '';
            $step = 'Pending';
            if ($this->step_id > 5) {
                $class = 'active';
                $step = '<span class=""><i class="fa fa-check"></i> Done</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . link_to_route('steady_aim_shoot', 'View', [], ['class' => 'btn btn-info']);
            }
        }

        if($status == true) {
            return $class;
        }
        return $step;
    }

    public function vatprice($only = false) {
        $price = $this->item_amount;
        $p = $price / 1.22;
        $p =  round($p);
        return $p;
    }

	 public static function getNextInvoiceNumber() {
		 $currentYear = date('Y');
		 $order = Order::orderBy('id', 'desc')->first();
		 if($order == null || $order->invoice_number == null) {
			 return "1-" . $currentYear;
		 }
		 $lastInvoiceNumber = $order->invoice_number;
		 $invoiceNumberArray = explode("-", $lastInvoiceNumber);
		 $numero = $invoiceNumberArray[0];
		 $anno = $invoiceNumberArray[1];
		 $currentYear = date('Y');

		 if($anno == $currentYear) {
			 $numero ++;
			 return $numero . "-" . $currentYear;
		 } else {
			 return "1-" . $currentYear;
		 }
	 }
}
