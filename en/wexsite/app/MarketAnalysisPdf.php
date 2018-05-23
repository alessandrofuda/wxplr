<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketAnalysisPdf extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'market_analysis_id','market_analysis_pdf','market_analysis_pdf_label','market_analysis_pdf_unique_name'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'market_analysis_pdfs';
}
