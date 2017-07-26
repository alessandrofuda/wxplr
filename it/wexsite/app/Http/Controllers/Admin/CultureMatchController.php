<?php

namespace App\Http\Controllers\Admin;
use App\Order;
use App\Setting;
use Validator;
use Illuminate\Http\Request;
use App\User;use Auth;
use App\SurveyCode;use App\CultureMatchSurvey;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CultureMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $survey_code = SurveyCode::all();
        $data['page_title'] = 'Culture Match';
        $data['survey_code'] = $survey_code;
        return view('admin.culture_match',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $data['page_title'] = 'Upload Survey Code';
        $data['page_type'] = 'create';        
        return view('admin.survey_code_assign_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$file = $request->file('survey_codes_file');
        $validator = Validator::make(
									[
										'attachment' => $file,
										'extension'  => $file->getClientOriginalExtension(),
									],
									[
										'attachment' => 'required',
										'extension'  => 'required|in:csv',
									]
		);

        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }

		$csv_file = $request->file('survey_codes_file');
		$file = fopen($csv_file,"r");
		fgets($file);

        while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
			$survey_code_obj = SurveyCode::create([
								'label'=>$data[0],
								'survey_code'=>$data[1]
								]);
		}

		fclose($file);

        return redirect('admin/cuture_match/survey_code')->with('status', 'Survey Codes has been Uploaded!');
    }

    public function upload(Request $request, $id)
    {
        $file = $request->file('upload_file');
        $result = [ 'status' => 'NOK'];
      /*  $validator = Validator::make(
            [
                'attachment' => $file,
                'extension'  => $file->getClientOriginalExtension(),
            ],
            [
                'attachment' => 'required',
                'extension'  => 'required|in:pdf',
            ]
        );
        if ($validator->fails()) {
            return $result;
        }*/
        $pdf_file = $request->file('upload_file');
        $culture_match = CultureMatchSurvey::find($id);
        $user = $culture_match->user;;
        $data['user'] = $user;
        $setting = Setting::first();
        $file = $pdf_file->getPathName();
        if( \Mail::send('emails.client_culture_match_pdf', $data, function($message) use($user, $setting, $file)
        {
            $message->to($user->email);
            $message->subject('Find you Culture Match Survey Report');
            $message->from($setting->website_email);
            $message->attach($file, array(
                    'as' => 'pdf-report',
                    'mime' => 'application/pdf')
            );
        })){
            $result['status'] = 'OK';
            $culture_match->update([
                'is_pdf_sent' => CultureMatchSurvey::PDF_SENT,
                'sent_date' => date('Y-m-d H:i:s')
            ]);
            $result['email'] = $user->email;
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $culture_match = SurveyCode::find($id);		
        $data['page_title']='Edit Survey Code';
		$data['page_type']='edit';
		$data['culture_match']=$culture_match;
        $data['user_listing'] = $users;
        return view('admin.survey_code_assign_form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request_arr['user_id'] = 'required';
		$request_arr['survey_code'] = 'required';
        $validator = Validator::make($request->all(), $request_arr);
        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $user_id=trim($request['user_id']);
		$survey_code=trim($request['survey_code']);
        if(isset($request['survey_code_status'])){
            $status = $request['survey_code_status'];
        }else{
            $status = 0;
        }
        $culture_match = array('user_id'=>$user_id,
                               'survey_code'=>$survey_code,
                               'status'=>$status);
        $culture_match_survey_obj = SurveyCode::find($id)->update($culture_match);		
        return redirect('admin/cuture_match/survey_code')->with('status', 'Survey Code has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Code
        $culture_match = SurveyCode::find($id);
        $culture_match->delete();		
        return redirect('admin/cuture_match/survey_code')->with('status', 'Survey Code has been deleted!');
    }
    public function survey_return_callback(){
		$uid = Auth::user()->id;
		CultureMatchSurvey::where('user_id',$uid)->update(['status'=>0]);

        $order = Order::where('user_id',$uid)->where('item_name','Professional Kit')->first();

        if($order != null) {
            if($order->step_id < 3) {
                $order->update([
                    'step_id' => 3
                ]);
            }
        }

		/*if(isset($_POST)){
			echo '<pre>-----post';print_r($_POST);
		}
		if(isset($_REQUEST)){
			echo '<pre>-----request';print_r($_REQUEST);
		}*/
		return redirect('user/dream_check_lab')->with('status', 'Survey has been completed!');
    }
}
