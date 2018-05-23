<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenderPdf extends Model
{
    use SoftDeletes;
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'gender','gender_pdf','gender_pdf_name'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gender_pdfs';
}
