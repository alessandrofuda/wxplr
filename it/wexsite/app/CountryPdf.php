<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryPdf extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'country_name','country_pdf','country_pdf_label'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'country_pdfs';
}
