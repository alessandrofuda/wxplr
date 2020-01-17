<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model {

	protected $guarded = ['updated_at', 'created_at'];
    protected $table = 'user_reports';

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
