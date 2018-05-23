<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model {

	 use SoftDeletes;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',   'country_code','country_name'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

	 public static function all($columns = Array()) {
		 return Country::orderBy('country_name', 'asc')->get();
	 }

}
