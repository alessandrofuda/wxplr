<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',  'user_id', 'first_name', 'last_name', 'email', 'phone_number', 'city', 'state', 'post_code', 'country',
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_addresses';
}
