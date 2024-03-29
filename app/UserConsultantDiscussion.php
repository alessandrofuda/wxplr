<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;

class UserConsultantDiscussion extends Model
{

	protected $table = 'user_consultant_discussions';
	
	protected $fillable = ['user_id', 'discuss_id', 'message'];



    //relationship
    public function user()
    {
    	return $this->belongsTo('App\User');
    }


}
