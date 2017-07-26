<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',  'page_title','machine_name','description'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';
}
