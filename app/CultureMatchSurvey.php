<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CultureMatchSurvey extends Model
{
    const PDF_SENT = 1;
    const PDF_NOT_SENT = 0;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deleted_at', 'user_id','survey_code','status','is_pdf_sent','pdf_path','sent_date'
    ];
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'culture_match_survey';
	/**
	 * Get user detail of particular culture
	 */
	public function user()
    {
        return $this->belongsTo('App\User');
    }
    public static function getSentOptions($id = null) {
        $list = [
            self::PDF_NOT_SENT => 'Pdf Not Sent',
            self::PDF_SENT => 'Pdf Sent'
        ];
        if($id == null)
            return $list;
        if(is_numeric( $id))
            return $list[$id];
        return $id;
    }

}
