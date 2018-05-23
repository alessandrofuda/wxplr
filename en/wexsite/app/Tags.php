<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',
        'name',
        'created_by',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Get the user feedback for the Dream check lab submission.
     */
    public function videos()
    {
        return $this->hasMany('App\VideoTags', 'tag_id');

    }
}
