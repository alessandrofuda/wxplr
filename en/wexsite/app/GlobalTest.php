<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalTest extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'question','parent_choice'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'global_test';
    /**
     * Get the choices for the question.
     */
    public function questionChoices()
    {
        return $this->hasMany('App\GlobalTestChoices','question_id');
    }
}
