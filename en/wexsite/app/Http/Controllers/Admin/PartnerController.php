<?php

namespace App\Http\Controllers\Admin;

use App\Partners;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Partners';
        $partners = Partners::all();
        $data['partners'] = $partners;
        return view('admin.partners',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create Partner';
        $data['page_type'] = 'create';
        return view('admin.create_partner',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules['name'] = 'required';
        $rules['logo_file'] = 'required';
        $rules['description'] = 'required';
        $rules['url'] = 'required|url';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $request_arr['name'] = trim($request->get('name'));
        $request_arr['description'] = trim($request->get('description'));
        $request_arr['url'] = trim($request->get('url'));
        $logo_file = $request->file('logo_file');
        $request_arr['logo_file'] = Setting::saveUploadedImage($logo_file);
        $partner_obj = Partners::create($request_arr);
        return redirect('/admin/partners')->with('status','Partner Added Successfully');
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
        $data['page_title'] = 'Edit Partner';
        $data['page_type'] = 'edit';
        $partner = Partners::find($id);
        $data['partner'] = $partner;
        return view('admin.create_partner',$data);
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
        $partner_obj = Partners::find($id);
        $rules['name'] = 'required';
        $rules['description'] = 'required';
        $rules['url'] = 'required:url';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $request_arr['name'] = trim($request->get('name'));
        $request_arr['description'] = trim($request->get('description'));
        $request_arr['url'] = trim($request->get('url'));
        $logo_file = $request->file('logo_file');
        $request_arr['logo_file'] = Setting::saveUploadedImage($logo_file,$partner_obj->logo_file);
        $partner_obj->update($request_arr);
        return redirect('/admin/partners')->with('status','Partner updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partners::find($id);
        $partner->delete();
        return redirect('/admin/partners')->with('status', 'Partner Deleted Successfully');
    }
}
