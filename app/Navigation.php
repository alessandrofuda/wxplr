<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Navigation extends Model
{
    use SoftDeletes;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'title','path'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'navigations';
}
