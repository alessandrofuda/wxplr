<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $fillable = [
        'user_id', 'package_id','used_count','code_id','state_id','transaction_id'
    ];
    protected $table = 'user_packages';
    public function package() {
        return $this->belongsTo('App\Package','package_id');
    }
    public function user() {
        return $this->belongsTo('App\User','user_id');
    }
    public function transactionPrice() {
        $order = Order::where('item_id' , $this->package_id)->where('user_id', \Auth::user()->id)->where('item_type', 'package')->first();

        return isset($order->transaction->amount) ? $order->transaction->amount : 0;
    }
    public function code() {
        return $this->belongsTo('App\PreferentialCodes','code_id');
    }
    public function getServicesStatus() {

        $skill_array = explode('-', $this->package->skills);
        $used_count_array = explode('-', $this->used_count);
        $skill_count_arr = array_combine($skill_array, $used_count_array);
        $status = '';
        foreach($skill_count_arr as $skill => $count) {
                $status .= $this->package->getSkillOptions($skill).' => '.$count.' => '.$this->users().'<br/>';
        }
        return $status;
    }
    public function users() {
        $user = $this->user->name;
        if(isset($this->code->transactions)) {
            $transactions = $this->code->transactions;
            if ($transactions != null)
                foreach ($transactions as $transaction) {
                    $user .= ', ' . $transaction->createUser->name;
                }
        }
        return $user;

    }


}
