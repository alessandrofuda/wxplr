<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DreamCheckLabFeedback extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',
        'dream_check_lab_id',
        'cv_file',
        'achievement1',
        'achievement2',
        'achievement3',
        'place',
        'promotion_usp',
        'feedback_form'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dream_check_lab_feedback';

    public function dreamchecklab() {
        return $this->belongsTo('App\DreamCheckLab', 'dream_check_lab_id');
    }
}
