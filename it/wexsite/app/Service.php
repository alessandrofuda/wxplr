<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    public $vatprice;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'name','image','user_dashboard_image','type','price','description',
        'user_dashboard_desc', 'currency_code'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';
    public function vatprice($only = false) {
        $price = $this->price;
        $p = $price / 1.22;
        $p =  round($p);
        return $p;
    }
    public static function usdprice($from,$to,$am) {
       $converted = $am;
        if($from == null)
            $from = 'EUR';
        if($to == null)
            $to = 'USD';
        $to = trim($to);
        $from = trim($from);

        if($to != $from && $am > 0) {
            $url = "https://www.google.com/finance/converter?a=$am&from=$from&to=$to";
            $data = file_get_contents($url);
            preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
            $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        }
        return round($converted, 3);
    }
    public function checkCode($code) {
        $code_arr = [];
        if($code != null) {
            $code = trim($code);
            $code_prev_obj = PreferentialCodes::where('preferential_code',$code)
              ->where('type_id',PreferentialCodes::PRODUCT_TYPE_SERVICE)
                ->where('product_id',$this->id)
                ->first();
            $ok = false;
            $used_count = '';
            $user_package_id = 0;
            if($code_prev_obj == null) {

                $code_prev_obj = PreferentialCodes::where('preferential_code', $code)
                    ->where('type_id', PreferentialCodes::PRODUCT_TYPE_USER_PACKAGE)
                    ->first();

                if($code_prev_obj != null) {
                    $userPackage = UserPackage::where('code_id', $code_prev_obj->id)->first();
                    if($userPackage != null) {
                        $user_package_id =  $userPackage->id;
                        $used_count = $userPackage->used_count;

                        $package = Package::where('id', $userPackage->package_id)->first();
                        $skill_arr = explode('-', $package->skills);
                        $type = Package::SKILL_PROFESSIONAL_KIT;
                        if($this->name == 'Global Toolbox')
                            $type = Package::SKILL_GLOBAL_TOOL_BOX;

                        if(in_array($type, $skill_arr)) {
                            $count_arr = explode('-', $userPackage->used_count);
                            $skill_count_arr = array_combine($skill_arr,$count_arr);
                            if($skill_count_arr[$type] > 0 ) {
                                $ok = true;
                                $skill_count_arr[$type] = $skill_count_arr[$type] - 1;
                                $used_count = implode('-',array_values($skill_count_arr));
                            }
                        }

                    }
                }
            }

            if($code_prev_obj != null || $ok == true) {
                $amount = $this->price * $code_prev_obj->discount / 100;
                if($amount > 0) {
                    //$amount = Service::usdprice($this->currency_code, 'USD', $amount);
                    if ($code_prev_obj->end_date > date('Y-m-d')) {
                        if ($code_prev_obj->is_single == PreferentialCodes::SINGLE_USAGE) {
                            $transaction = OrderTransaction::where('code_id', $code_prev_obj->id)->first();
                            if ($transaction == null) {
                                $code_arr['id'] = $code_prev_obj->id;
                                $code_arr['amount'] = $amount;
                                $code_arr['used_count'] = $used_count;
                                $code_arr['user_package'] = $user_package_id;
                                return $code_arr;
                            }
                        } else {
                            $ok = true;
                            if(Auth::check()) {
                                $transaction = OrderTransaction::where('code_id',$code_prev_obj->id)->where('created_by',Auth::user()->id)->first();
                                if($transaction != null)
                                    $ok = false;
                            }
                            if($ok == true) {
                                $code_arr['id'] = $code_prev_obj->id;
                                $code_arr['amount'] = $amount;
                                $code_arr['user_package'] = $user_package_id;
                                $code_arr['used_count'] = $used_count;
                            }
                            return $code_arr;
                        }
                    }
                }
            }


        }
        return $code_arr;
    }
}
