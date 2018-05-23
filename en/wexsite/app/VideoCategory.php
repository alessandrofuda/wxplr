<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['deleted_at', 'category_name', 'category_desc'];
	protected $table = 'video_categories';
}
