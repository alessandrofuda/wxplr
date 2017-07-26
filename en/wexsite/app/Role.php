<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    const ROLE_ADMIN = 1;
    const ROLE_CONSULTANT = 2;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'role_name',
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';



    // testing ..
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_roles');
    }




}
