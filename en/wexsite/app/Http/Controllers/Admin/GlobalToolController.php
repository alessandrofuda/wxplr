<?php

namespace App\Http\Controllers\Admin;

use App\ConsultantProfile;
use App\ConsultantServices;
use App\GlobalToolQuery;
use Validator;
use Illuminate\Http\Request;
use Mail;
use Auth;
use App\Setting;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GlobalToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['page_title'] = 'All Queries';
        $queries = GlobalToolQuery::all();
        $data['queries'] = $queries;
        return view('admin.queries',$data);
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
        $query = GlobalToolQuery::where('id',$id)->first();
        $data['page_title'] = "Query";
        $data['query'] = $query;
        return view('admin.show_query',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = GlobalToolQuery::where('id',$id)->first();
        $data['page_title'] = "Edit Query";
        $data['query'] = $query;

        $consultants = ConsultantServices::select('consultant_services.*')
            ->where('consultant_services.service_id', $query->question_type_id)
            ->join('consultant_profile','consultant_profile.user_id','=','consultant_services.user_id')
            ->where('consultant_services.state_id',ConsultantServices::STATE_ACTIVE)
            ->where('consultant_profile.country_expertise',$query->country)
            ->get();
        $data['consultants'] = $consultants;
        return view('admin.query_edit',$data);
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
        $query = GlobalToolQuery::where('id',$id)->first();
        $data['page_title'] = "Query";
        $data['query'] = $query;
        $rules['consultant_id'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $consultant = ConsultantProfile::where('user_id',$request->get('consultant_id'))->first();

        if($query->update([
            'consultant_id' => $consultant->user_id,
            'state_id' => GlobalToolQuery::STATE_ASSIGNED
        ])) {

            Mail::send('emails.global_tool_consultant_notification', ['query' => $query], function ($m) use ($consultant) {
                $settings = Setting::find(1);
                $site_email = $settings->website_email;
                $m->from(Auth::user()->email, 'Wexplore');
                $m->to($consultant->user->email, 'Wexplore')->subject('No Country Expert Found.!');
            });

            Mail::send('emails.global_tool_client_notification', ['query' => $query], function ($m) use ($query) {
                $settings = Setting::find(1);
                $site_email = $settings->website_email;
                $m->from(Auth::user()->email, 'Wexplore');
                $m->to($query->user->email, 'Wexplore')->subject('No Country Expert Found.!');
            });
        }
        return redirect('admin/queries')->with('status', 'Query Assigned to selected consultant!');
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
