<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VideoTags extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',
        'video_id',
        'tag_id',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'video_tags';

    /**
     * Get the user feedback for the Dream check lab submission.
     */
    public function video()
    {
        return $this->belongsTo('App\Video', 'video_id');
    }
    public function tag()
    {
        return $this->belongsTo('App\Tags', 'tag_id');
    }
}
