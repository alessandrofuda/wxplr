<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgePdf extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'age_range','age_pdf','age_pdf_name','deleted_at'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'age_pdfs';
}
