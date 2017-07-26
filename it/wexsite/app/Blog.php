<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Blog extends Model
{
    use SoftDeletes;
    protected $table = 'blog';
    protected $fillable = ['title','description','image_file','created_by','deleted_at'];
    public function createUser(){
        return $this->hasOne('App\User','id','created_by');
    }
}
