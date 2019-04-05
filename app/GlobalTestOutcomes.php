<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalTestOutcomes extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'outcome_name','choice_id','outcome_image','outcome_file','description'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'global_test_outcomes';
    /**
     * Get the Choices that owns the question.
     */
    public function choices()
    {
        return $this->belongsTo('App\GlobalTestChoices','choice_id');
    }
}
