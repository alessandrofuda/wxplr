<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketAnalysis extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at',  'market_analysis_type','market_analysis_desc'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'market_analysis';
    /**
     * The Market Analysis Pdfs that belong to this.
     */
    public function MarketAnalysisPdf()
    {
        return $this->hasMany('App\MarketAnalysisPdf','market_analysis_id');
    }
}
