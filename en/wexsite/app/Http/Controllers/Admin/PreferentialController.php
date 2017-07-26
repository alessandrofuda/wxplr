<?php

namespace App\Http\Controllers\Admin;

use App\PreferentialCodes;
use App\Service;
use App\Setting;
use App\SkillDevelopmentVideos;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PreferentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = PreferentialCodes::where('type_id','!=',PreferentialCodes::PRODUCT_TYPE_USER_PACKAGE)->get();
        $data['page_title'] = 'Codes';
        $data['codes'] = $codes;
        return view('admin.preferential_codes',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title']='Create Preferential Codes';
        $data['page_type']='view';
        $data['product_types'] = PreferentialCodes::getTypeOptions();
        $services = Service::all();
        $data['services'] = $services;
        $videos = SkillDevelopmentVideos::all();
        $data['videos'] = $videos;
        return view('admin.preferential_code_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules['preferential_code']='required|unique:preferential_codes,preferential_code';
        array_map('trim', $request->all());
        $rules['type_id'] = 'required';
        $rules['product_id'] = 'required';
        $rules['discount'] = 'required|max:100';
        $rules['is_single'] = 'required';
        $rules['end_date'] = 'required';
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $code_arr['label'] = trim ($request->get('label'));
        $code_arr['type_id'] = trim($request->get('type_id'));
        $code_arr['product_id'] = trim($request->get('product_id'));
        $code_arr['discount'] = trim($request->get('discount'));
        $code_arr['is_single'] = trim($request->get('is_single'));
        $date = date('Y-m-d',strtotime($request->get('end_date')));
      //  $date = Setting::dateUtc($date);
        $code_arr['end_date'] = $date;
        $code_arr['preferential_code'] = trim($request->get('preferential_code'));
        $code_obj = PreferentialCodes::create($code_arr);
        return redirect('admin/codes')->with('status', 'Code has been created!');
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
        $code = PreferentialCodes::find($id);
        $data['page_title'] = 'Codes';
        $data['page_type'] = 'edit';
        $data['code'] = $code;
        $data['product_types'] = PreferentialCodes::getTypeOptions();
        $services = Service::all();
        $data['services'] = $services;
        $videos = SkillDevelopmentVideos::all();
        $data['videos'] = $videos;
        return view('admin.preferential_code_add',$data);
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
        $rules['preferential_code'] = 'required|unique:preferential_codes,preferential_code,'.$id;
        $rules['type_id'] = 'required';
        $rules['product_id'] = 'required';
        $rules['discount'] = 'required|max:100';
        $rules['is_single'] = 'required';
        $rules['end_date'] = 'required';
     //   $rules['preferential_code']='required|unique:preferential_codes,preferential_code,'.$id;
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $code_arr['label'] = trim($request->get('label'));
        $code_arr['type_id'] = $request->get('type_id');
        $code_arr['product_id'] = $request->get('product_id');
        $code_arr['discount'] = $request->get('discount');
        $code_arr['is_single'] = $request->get('is_single');
        $date = date('Y-m-d',strtotime($request->get('end_date').' 00:00:00'));
        //$date = Setting::dateUtc($date);
        $code_arr['end_date'] = $date;
        $code_arr['preferential_code'] = trim($request->get('preferential_code'));
        $code_obj = PreferentialCodes::find($id);
        if($code_obj == null)
            $code_obj = PreferentialCodes::create($code_arr);
        else
            $code_obj->update($code_arr);
        return redirect('admin/codes')->with('status', 'Code has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $code = PreferentialCodes::find($id);
        $code->delete();
        return redirect('admin/codes')->with('status', 'Code deleted!');
    }
}
