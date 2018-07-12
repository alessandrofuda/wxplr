<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalTestResult extends Model
{

    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'user_id','outcome_id'
    ];

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'global_test_result';

}
