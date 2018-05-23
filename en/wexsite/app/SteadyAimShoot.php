<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SteadyAimShoot extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at','top_description','bottom_description','whats_now','steady_aim_shoot_pdf','steady_aim_shoot_pdf_label'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'steady_aim_shoot';
}
