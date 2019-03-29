<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'deleted_at', 'user_id','code_id','start_date','end_date','state_id','video_id','type_id','transaction_id'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_subscription';
}
