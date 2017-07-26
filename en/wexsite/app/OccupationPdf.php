<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OccupationPdf extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',  'occupation','occupation_pdf','occupation_pdf_name'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'occupation_pdfs';
}
