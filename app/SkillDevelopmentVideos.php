<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use getID3;

class SkillDevelopmentVideos extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'deleted_at',
        'video_title',
        'video_image',
        'uploaded_video',
        'video_category',
        'description',
        'video_type',
        'price',
        'currency_type',
        'preview_video',
        'vimeo_path',
        'preview_vimeo_path'
    ];

    protected $table = 'skill_development_videos';
	
	public function videoCategory()
    {
        return $this->belongsTo('App\VideoCategory','video_category');
    }

    public function videoTag()
    {
        return $this->hasOne('App\VideoTags','video_id');
    }

    public function getDuration() {
        $basePath = base_path();
        $getID3 = new \getID3();
        $file = $getID3->analyze($basePath.'/../'.$this->uploaded_video);

        if(isset($file['playtime_string']))
            return $file['playtime_string'];

        return 0;
    }
    
    public function checkCode($code) {
        $code_arr = [];

        if($code != null) {
            $code = trim($code);
            $code_obj = PreferentialCodes::where('preferential_code',$code)->where('type_id',PreferentialCodes::PRODUCT_TYPE_VIDEO)->where('product_id',$this->id)->first();

            if($code_obj != null) {
              $amount = $this->price * $code_obj->discount / 100;
                //$amount = Service::usdprice($this->currency_type,'USD',$amount);

                if($code_obj->end_date >= date('Y-m-d')) {

                    if($code_obj->is_single == PreferentialCodes::SINGLE_USAGE) {
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

    public function saveVideo() {
        $user_obj = Auth::user();
        $user_order_data = [
            'user_id' => $user_obj->id,
            'item_id' => $this->id,
            'item_name' => $this->video_title,
            'item_type' => 'video',
            'item_amount' => 0,
            'approved' => 1
        ];
        $order_obj = \App\Order::create($user_order_data);
        $order_id = $order_obj->id;
        $txn_id = 'FREE-TRANSACTION-'.$user_obj->id;
        $transaction_data = [
            'order_id' => $order_id,
            'transaction_id' => $txn_id,
            'amount' => 0,
            'transaction_type' => 'credit',
            'payment_gateway_id' => 2,
            'payment_method_id' => 1,
            'order_status' => 1,
            'type_id' => OrderTransaction::TYPE_VIDEO,
            'created_by' => Auth::user()->id,
            'code_id' => 0
        ];
        $transaction_obj = OrderTransaction::create($transaction_data);

        if($transaction_obj != null) {
            $subscription_arr['video_id'] = $this->id;
            $subscription_arr['transaction_id'] = $transaction_obj->id;
            $subscription_arr['user_id'] = $user_obj->id;
            $subscription_arr['start_date'] = date('Y-m-d');
            $subscription_arr['end_date'] = date('Y-m-d', strtotime("+1 month"));
            $subscription_obj = UserSubscription::create($subscription_arr);
        }

        return true;
    }

    public function checkPackage() {

        if(Auth::check()) {
            $userPackages = UserPackage::where('user_id',Auth::user()->id)->get();

            foreach ($userPackages as $userPackage) {
                $package = Package::where('id',$userPackage->package_id)->first();
                $skill_arr = explode('-',$package->skills);
                $count_arr = explode('-',$package->count);

                if(in_array(Package::SKILL_VIDEOS,$skill_arr)){
                    $skill_count_arr = array_combine($skill_arr,$count_arr);
                    $count_assign_arr = explode('-',$userPackage->used_count);
                    $skill_assign_count = array_combine($skill_arr,$count_assign_arr);

                    if($skill_assign_count[Package::SKILL_VIDEOS] > 0) {
                        $skill_assign_count[Package::SKILL_VIDEOS] = $skill_assign_count[Package::SKILL_VIDEOS] - 1;
                        $assign_count = implode('-',array_values($skill_assign_count));
                        $userPackage->update([
                            'used_count' => $assign_count
                        ]);

                        return true;
                    }

                }

            }

        }

        return false;
    }

    public function getIframe($attr = 'vimeo_path') {
        $id = explode('/',$this->$attr);

        if(isset($id[2])) {

            return '<iframe src="https://player.vimeo.com/video/'.$id[2].'" width="640" height="524" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe><p><a href="https://vimeo.com/183600534">Untitled</a> from <a href="https://vimeo.com/user56658511">Alessia Di Iacovo</a> on <a href="https://vimeo.com">Vimeo</a>.</p>';
        }

        return '';
    }

    public function subscriptions() {
        return $this->hasMany('App\Subscription');
    }

}
