<?php

namespace App;

use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    const SERVICE_PROFESSIONAL_KIT = 0;
    const SERVICE_GLOBAL_TOOL_BOX = 1;
    const SERVICE_LIVE_WEBINAR = 2;
    const SERVICE_ROLE_PLAY_INTERVIEW = 3;
    const SERVICE_CONTRACT_EVALUATION = 4;
    const GT_CULTURE_SUPPORT = 5;
    const SERVICE_GT_FREELANCE_SUPPORT = 6;
    const SERVICE_GT_PROFESSIONAL = 7;



    /* aggiunto 10/07/2018 */
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $alias = 'user_alias';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['deleted_at','name', 'surname','email', 'password', 'is_profile_complete','tos','is_active', 'timezone'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];







    public function checkService($id) {
        $cons_serv = ConsultantServices::where('user_id', $this->id)->where('service_id', $id)->first();

        if($cons_serv != null) {
            return $cons_serv->state_id;
        }

        return ConsultantServices::STATE_INACTIVE;
    }


    public function getCompletedSessions($type) {

        if($type == self::SERVICE_PROFESSIONAL_KIT) {
           return ConsultantBooking::join('consultant_availablities', 'consultant_availablities.id','=','consultant_bookings.availablity_id')
                                    ->where('consultant_availablities.consultant_id', $this->id)
                                    ->where('consultant_bookings.type_id', ConsultantBooking::TYPE_INTERVIEW)
                                    ->where('consultant_bookings.state_id', ConsultantBooking::STATE_COMPLETED)
                                    ->count();
        }else{
            $bookings = ConsultantBooking::join('consultant_availablities', 'consultant_availablities.id','=','consultant_bookings.availablity_id')
                ->where('consultant_availablities.consultant_id', $this->id)
                ->where('consultant_bookings.type_id', ConsultantBooking::TYPE_QUERY)
                ->where('consultant_bookings.state_id', ConsultantBooking::STATE_COMPLETED)
                ->get();
            $count = 0;

            foreach ($bookings as $booking) {
                $query = GlobalToolQuery::find($booking->query_id);

                if($query != null) {
                    if($query->question_type_id == $type)
                    ++$count;
                }

            }

            return $count;
        }

        return 0;
    }


    public function getAssignedUsers($type) {

        if($type == self::SERVICE_PROFESSIONAL_KIT) {
            return DreamCheckLab::where('validate_by', $this->id)->count();
        }

        if($type == self::SERVICE_LIVE_WEBINAR) {
            return EventBooking::join('events','event_bookings.event_id', '=', 'events.id')
                ->where('events.consultant_id', $this->id)->count();
        }

        if($type == self::SERVICE_ROLE_PLAY_INTERVIEW) {
            return GlobalToolQuery::where('consultant_id', $this->id)->where('question_type_id', GlobalToolQuery::AREA_ROLE_PLAY_INTERVIEW)->count();
        }

        if($type == self::SERVICE_CONTRACT_EVALUATION) {
            return GlobalToolQuery::where('consultant_id', $this->id)->where('question_type_id', GlobalToolQuery::AREA_CONTRACT_EVALUATION)->count();
        }

        if($type == self::GT_CULTURE_SUPPORT) {
            return GlobalToolQuery::where('consultant_id', $this->id)->where('question_type_id', GlobalToolQuery::AREA_CULTURE_SUPPORT)->count();
        }

        if($type == self::SERVICE_GT_FREELANCE_SUPPORT) {
            return GlobalToolQuery::where('consultant_id', $this->id)->where('question_type_id', GlobalToolQuery::AREA_FREELANCE_SUPPORT)->count();
        }

        if($type == self::SERVICE_GT_PROFESSIONAL) {
            return GlobalToolQuery::where('consultant_id', $this->id)->where('question_type_id', GlobalToolQuery::AREA_PROFESSIONAL_TROUBLESHOOTING)->count();
        }
        return 0;

    }



    public function getInterestedCountry($service_id) {
        $country = isset($this->userProfile->country) ? $this->userProfile->country : "--";

        if($service_id == self::SERVICE_PROFESSIONAL_KIT) {
                $dream_chek_lab = DreamCheckLab::where('user_id', $this->id)->first();
                if(isset($dream_chek_lab->interest_country)) {
                    $country = $dream_chek_lab->interest_country;
                    return $country;
                }

                return $country;
        }

        if($service_id == self::SERVICE_GLOBAL_TOOL_BOX) {
            $order = Order::where('item_name', 'Global ToolBox')
                ->where('user_id', $this->id)->first();

            if($order != null) {
                $query = GlobalToolQuery::where('user_id', $this->id)->first();

                if($query != null) {
                    $country =  $query->country;
                    return $country;
                }
            }

            return 'Not Purchased Yet';

        }

        return $country;
    }

    public function userRoles()
    {
        return $this->hasMany('App\UserRoles');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role','user_roles');
    }

    public function role()
    {
        return $this->hasOne('App\UserRoles','user_id');
    }

    public function userProfile()
    {
        return $this->hasOne('App\UserProfile','user_id');
    }

    public function userAddresses() {
        return $this->hasMany('App\UserAddress', 'user_id');
    }

    public function consultantProfile()
    {
        return $this->hasOne('App\ConsultantProfile','user_id');
    }

    /**
     * Get the consultants with same country of interest and country expertise.
     */
    public function consultantList()
    {
        return $this->hasOne('App\ConsultantProfile','user_id');
    }

    public static function getOccupationsList() {
        $list =
            [
                'Managers',
                'Professionals',
                'Technicians',
                'Clerical',
                'Service and Sale',
                'Crafts Related Trade',
                'Plant Machine operators'
            ];
        return $list;

    }
    public static  function getOccupationText($occupation){
        $text = '';
        if($occupation == 'Managers')  {
            $text = 'You are a Manager if you: plan, direct, coordinate and evaluate the overall activities of your organization and/or organizational units, and formulate and review their policies, laws, rules and regulations';
        }
        if($occupation == 'Professionals')  {
            $text = 'You are a Professional if your work involves: increasing the existing stock of knowledge within your organization and/or applying scientific or artistic concepts, theories, frameworks and methodologies in your work';
        }
        if($occupation == 'Technicians')  {
            $text = 'You are a Technician if you:  perform mostly technical and related tasks connected with research and the application of operational methods';
        }if($occupation == 'Clerical')  {
            $text = 'You are a Clerical support worker if you: record, organise, store, compute and retrieve information for duties in connection with money-handling operations, travel arrangements, requests for information, and appointments';
        }
        if($occupation == 'Service and Sale')  {
            $text = 'You are a Service and sales worker if you: provide personal and protective services related to travel, housekeeping, catering, personal care, or demonstrate and sell goods in wholesale or retail shops and similar establishments';
        }
        if($occupation == 'Crafts Related Trade')  {
            $text = 'You are a Craft and related trades worker if you: apply specific knowledge and skills in the fields to construct and maintain buildings, machinery, equipment or tools; produce or process foodstuffs, textiles, or wooden, metal and other articles, including handicraft goods with the support of tools to reduce the amount of physical effort and time required for specific tasks, as well as to improve the quality of the products';
        }
        if($occupation == 'Plant Machine operators')  {
            $text = 'You are a Plant and machine operator if you: operate and monitor industrial and agricultural machinery and equipment on the spot or by remote control, drive and operate trains, motor vehicles and mobile machinery and equipment, or assemble products from component parts according to strict specifications and procedures';
        }
        return $text;
    }

    public static function getIndustryList() {
        $list =
            [
                'Agriculture',
                'Manufacturing',
                'Electricity',
                'Wholesale',
                'Transport',
                'ICT',
                'Financial Services',
                'Professional Services',
                'Public Administration',
                'Administrative Services',
                'Education',
                'Health',
                'Arts',
                'Other Services',
            ];
        return $list;
    }
    public static  function getIndustryText($industry){
        $text = '';
        if($industry == 'Agriculture')  {
            $text = 'Includes agriculture, foresting, fishing, mining and quarrying';
        }
        if($industry == 'Manufacturing')  {
            $text = 'Any industry involving the physical or chemical transformation of materials, substances or components into new products, either finished or semi-finished';
        }
        if($industry == 'Electricity')  {
            $text = 'Any industry involving the distribution of electricity, gas, and steam, but also waste management and construction';
        }if($industry == 'Wholesale')  {
            $text = 'Includes any wholesale or retail distribution activity, including packaging and storing, but also accommodation and food activities, and household assistance';
        }
        if($industry == 'Transport')  {
            $text = 'Passenger or freight transport, including postal and courier activities';
        }
        if($industry == 'ICT')  {
            $text = 'Any industry related to production, distribution, and processing of data and/or information';
        }
        if($industry == 'Financial Services')  {
            $text = 'Financial, insurance or real estate activities';
        }
        if($industry == 'Professional Services')  {
            $text = 'Activities requiring a high degree of training, which involves making know-how available to others. For example management consulting activities';
        }
        if($industry == 'Public Administration')  {
            $text = 'Includes governmental activities and those for international NGOs';
        }
        if($industry == 'Administrative Services')  {
            $text = 'Basic support activities to business operations, from payroll to tax accounting';
        }
        if($industry == 'Education')  {
            $text = 'Includes education at any level and for any profession, whether public or private';
        }
        if($industry == 'Health')  {
            $text = 'Healthcare activities delivered at sanitary or residential institutions';
        }
        if($industry == 'Arts')  {
            $text = 'Includes entertainment, recreation, gambling, and sports';
        }
        if($industry == 'Other Services')  {
            $text = 'Anything not fitting the descriptions above';
        }
        return $text;
    }

    public function getDocuments() {
        $docs = [];

        $dreamchecklab = DreamCheckLab::where('user_id', $this->id)->first();

        if($dreamchecklab != null) {
            $consultant = User::find($dreamchecklab->validate_by);

            if(\Auth::user()->id == $this->id || \Auth::user()->isAdmin() || $consultant->id == \Auth::user()->id) {
                $consultant_name = '';
                $date = '';
                if ($consultant != null) {
                    $consultant_name = $consultant->name . ' ' . $consultant->surname;
                }

                $date = $dreamchecklab->created_at;

                if ($dreamchecklab->cv_file != '') {
                    $file = base64_encode($dreamchecklab->cv_file);
                    $docs[] = [
                    'title' => 'Dream check Lab CV ',
                    'consultant_name' => $consultant_name,
                    'date' => $date,

                    'url' => url('/get-download/'. $file),
                    ];
                }

                if ($dreamchecklab->form_pdf != '') {
                    $file = base64_encode($dreamchecklab->form_pdf);
                    $docs[] = [
                    'title' => 'Dream check Lab Form',
                    'consultant_name' => $consultant_name,
                    'date' => $date,
                    'url' => url('/get-download/'. $file),
                    ];
                } else {
                    $base_path = base_path();
                    $base_path = str_replace("/wexsite", "", $base_path);
                    $pdf_path = '/uploads/dream_form_' . time() . '.pdf';

                    $viewdata['dream_check_lab'] = $dreamchecklab;
                    $viewdata['page_title'] = 'Dream Check Lab Form';
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadView('client.dream_check_lab_pdf', $viewdata);
                    $pdf->save($base_path . $pdf_path);

                    $dreamchecklab->update([
                        'form_pdf' => $pdf_path
                        ]);
                    $file = base64_encode($dreamchecklab->form_pdf);

                    $docs[] = [
                    'title' => 'Dream check Lab Form ',
                    'consultant_name' => $consultant_name,
                    'date' => $date,
                    'url' => url('/get-download/'. $file),
                    ];

                }

                $feedback = DreamCheckLabFeedback::where('dream_check_lab_id', $dreamchecklab->id)->first();

                if ($feedback != null) {
                    if ($consultant != null) {
                        $consultant_name = $consultant->name . ' ' . $consultant->surname;
                    }

                    $date = $feedback->created_at;
                    if ($feedback->feedback_form == null) {
                        $base_path = base_path();
                        $base_path = str_replace("/wexsite", "", $base_path);
                        $pdf_path = '/uploads/dream_feedback_form_' . time() . '.pdf';

                        $viewdata['dream_check_lab_feedback'] = $feedback;
                        $viewdata['page_title'] = 'Dream check Lab Feedback Form';
                        $pdf = \App::make('dompdf.wrapper');
                        $pdf->loadView('client.dream_check_lab_feedback_pdf', $viewdata);
                        $pdf->save($base_path . $pdf_path);

                        $feedback->update([
                            'feedback_form' => $pdf_path
                            ]);
                    }
                    $file = base64_encode($feedback->feedback_form);

                    $docs[] = [
                    'title' => 'Dream check Lab Form - <b>Feedback</b>',
                    'url' => url('/get-download/'. $file),
                    'consultant_name' => $consultant_name,
                    'date' => $date,
                    ];
                    if ($feedback->cv_file != null) {
                        $file = base64_encode($feedback->cv_file);
                        $docs[] = [
                        'title' => 'Dream check Lab CV - <b>Feedback</b>',
                        'url' => url('/get-download/'. $file),
                        'consultant_name' => $consultant_name,
                        'date' => $date,
                        ];
                    }
                }
            }
        }

        $culturematch = CultureMatchSurvey::where('user_id', $this->id)
                                          ->where('is_pdf_sent', CultureMatchSurvey::PDF_SENT)
                                          ->first();

        if($culturematch != null && (\Auth::user()->id == $this->id || \Auth::user()->isAdmin())) {
            $file = base64_encode($culturematch->pdf_path);
            $docs[] = [
            'title' => 'Culture Match Report',
            'url' => url('/get-download/'. $file),
            'consultant_name' => 'Admin',
            'date'=>$culturematch->sent_date,
            ];
        }

        $global_tool_query = GlobalToolQuery::where('user_id', $this->id)
                                            ->whereNotNull('feedback_form')
                                            ->where('feedback_form', '!=', '')
                                            ->get();

        if(count($global_tool_query) > 0 ) {
            foreach ($global_tool_query as $query) {
                $consultant = User::find($query->consultant_id);
                $consultant_name = '';
                $date = '';
                if($consultant != null) {
                    $consultant_name = $consultant->name.' '.$consultant->surname;
                }

                if(\Auth::user()->id == $this->id || \Auth::user()->isAdmin() || $consultant->id == \Auth::user()->id) {
                    $file = base64_encode($query->feedback_form);
                    $docs[] = [
                    'title' => 'Global Tool Query Feedback Form',
                    'url' => url('/get-download/'. $file),
                    'url' => url('/get-download/'. $file),
                    'consultant_name' => $consultant_name,
                    'date' => $query->created_at,
                    ];
                }
            }
        }

        $bookings = ConsultantBooking::where('user_id', $this->id)
                                    ->whereNotNull('recording')
                                    ->where('recording', '!=', '')
                                    ->get();

        if(count($bookings) > 0 ) {
            foreach ($bookings as $booking) {
                if($booking->availablity != null) {
                    $consultant = User::find($booking->availablity->consultant_id);
                    $consultant_name = '';
                    $date = '';
                    if ($consultant != null) {
                        $consultant_name = $consultant->name . ' ' . $consultant->surname;
                    }
                    if (\Auth::user()->id == $this->id || \Auth::user()->isAdmin() || $consultant->id == \Auth::user()->id) {
                        $file = base64_encode($booking->recording);
                        $docs[] = [
                        'title' => 'Professional Kit - Recording Conference Call',
                        'url' => url('/get-download/'. $file),
                        'consultant_name' => $consultant_name,
                        'date' => $booking->created_at,
                        ];
                    }
                }
            }
        }

        $date = array();
        foreach ($docs as $key => $row)
        {
            $date[$key] = $row['date'];
        }
        array_multisort($date, SORT_DESC, $docs);
        
        return $docs;
    }





    
    public static function exportToExcel($filename, $data) {
        $excel = \App::make('excel');
        $excel->create($filename, function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {

                $sheet->fromArray($data);

            });
        })->export('xls');
    }

	public function getUploadForm()
    {
        $user_code = CultureMatchSurvey::where('user_id', $this->id)->first();
        $data = 'User not found';

        if ($user_code != null) {
            $user = $user_code->user;

            if ($user != null) {
                $data = $user->name;

                if ($user_code->is_pdf_sent == CultureMatchSurvey::PDF_SENT) {
                    $data .= " <span id='message_" . $user_code->id . "'><i class='fa fa-check'></i> Pdf Already Sent</span>";
                }

                $data .= '<br/>';
                $data .= "<form method='POST' action='" . url('admin/culture_match/' . $user_code->id . '/upload') . "' id='form_" . $user_code->id . "'>" . csrf_field() . "<input required type='file' name='upload_file' id='file_" . $user_code->id . "'><div id='file_error_" . $user_code->id . "'></div></form>
		        <a  id='upload_file" . $user_code->id . "' class='btn btn-success'>Upload Culture Match Survey Feedback</a>";

            }

        }

        return $data;
    }

    public function isAdmin() {
        if(isset(\Auth::user()->role->role_id))
            if(\Auth::user()->role->role_id == Role::ROLE_ADMIN)
                return true;

        return false;
    }

    public function isConsultant() {
        if(isset($this->role->role_id))
            if($this->role->role_id == Role::ROLE_CONSULTANT)
                return true;

        return false;
    }

    public function getServicesCount($count = false) {
        $orders = Order::where('user_id', $this->id)->whereIn('item_name',['Professional Kit', 'Global Toolbox'])->groupBy('item_name');
        if($count == true) {
            $orders = $orders->count();
        }
        $orders = $orders->get();
        return $orders;
    }


    /**
    * param 
    * return array $email_receivers_array
    */
    public static function getNotificationList() {  // include: admins emails + site e-mail + others (from .ENV file)

        $admins = User::where('is_admin', 1)->get(['email'])->toArray();
            foreach($admins as $admin_email) {
                $notification_list[] = $admin_email['email'];
            }

            // add 
            $site_email = Setting::find(1)->website_email;
            array_push($notification_list, $site_email);

            // add any $others receivers that is NOT Admin --> defined in .env config file , comma separated list
            $additional_emails = env('NOTIFICATION_LIST_ADDITIONAL_EMAIL');

            if($additional_emails !== null) {
                $others = explode(',', trim($additional_emails, ','));
                foreach ($others as $other) {
                    array_push($notification_list, trim($other));  
                }
            }

            return $notification_list;
    }


}
