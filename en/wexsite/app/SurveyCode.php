<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyCode extends Model
{
    use SoftDeletes;
	protected $fillable = ['deleted_at','label','survey_code','is_assigned'];
    
    protected $table = 'survey_codes';
    
    public function getUploadForm() {
        $user_code = CultureMatchSurvey::where('survey_code', $this->survey_code)->first();
        $data = 'User not found';
     
        if($user_code != null) {
            $user = $user_code->user;
         
            if($user != null) {
                $data = $user->name;
               
                if($user_code->is_pdf_sent == CultureMatchSurvey::PDF_SENT) {
                    $data .= " <span id='message_".$user_code->id."'><i class='fa fa-check'></i> Pdf Already Sent</span>";
                }
                
                $data .= '<br/>';
                $data .= "<form method='POST' action='".url('admin/culture_match/'.$user_code->id.'/upload')."' id='form_".$user_code->id."'>".csrf_field()."<input required type='file' name='upload_file' id='file_".$user_code->id."'><div id='file_error_".$user_code->id."'></div></form>
                <a  id='upload_file".$user_code->id."' class='btn btn-success'>Upload File</a>";
           
            }
       
        }
        
        return $data;
    }
}
