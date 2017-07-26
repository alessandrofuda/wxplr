<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partners extends Model
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
        'description',
        'logo_file',
        'url',
        'created_by',
        'created_at',
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partners';
}
