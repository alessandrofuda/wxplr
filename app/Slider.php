<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $fillable = ['deleted_at','heading_1','heading_2', 'image_file'];
    protected $table = 'slider';
}
