<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRoles extends Model
{

    use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'user_id','role_id'
    ];

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_roles';

    protected $dates = ['deleted_at'];

}
