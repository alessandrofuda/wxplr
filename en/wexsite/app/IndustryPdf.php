<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndustryPdf extends Model
{
    use SoftDeletes;
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',   'industry','industry_pdf','industry_pdf_name'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'industry_pdfs';
}
