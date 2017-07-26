<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalTestChoices extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'question_id','choice'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'global_test_choices';
    /**
     * Get the Choices that owns the question.
     */
    public function globalTest()
    {
        return $this->belongsTo('App\GlobalTest','question_id');
    }
    /**
     * Get the Choices that owns the question.
     */
    public function outcome()
    {
        return $this->hasOne('App\GlobalTestOutcomes','choice_id');
    }
}
