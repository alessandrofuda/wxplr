<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;
use Validator;
use Mail;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index() {
        
        //
        
        return view('landing-page');
    }



    public function post(Request $request) {

        $to_email = env('MAIL_TO');  // 'info@wexplore.co';
        $to_email_ccn = env('MAIL_TO_CCN', '');
        //validation form
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
            'privacy' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('landing-page')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Mail
        $lead_data = [
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'bodyMessage' => $request->input('message')
        ];
        Mail::send('emails.landing-page', $lead_data, function ($m) use ($to_email, $to_email_ccn, $lead_data) {
            $settings = Setting::find(1);
            $site_email = $settings->website_email;
            $m->from($site_email, 'Wexplore');
            $m->to($to_email, 'Wexplore')->bcc($to_email_ccn)->subject('Landing Page, nuova richiesta da: '. $lead_data['firstname']. ' '. $lead_data['lastname']);
        });

        return redirect()->back()->with('success', 'Siamo contenti di averti incuriosito!<br/> Ti ricontatteremo entro 24 ore per rispondere alla tua richiesta.<br/> Se nel frattempo vuoi qualche notizia in più, seguici su <a class="social-btn" href="https://www.facebook.com/wexploreco">Facebook</a> o <a class="social-btn" href="https://it.linkedin.com/company/wexplore.co/">LinkedIn</a>. A presto!');
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
