<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationPdf extends Model
{
    use SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',  'education','education_pdf','education_pdf_name'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'education_pdfs';
}
