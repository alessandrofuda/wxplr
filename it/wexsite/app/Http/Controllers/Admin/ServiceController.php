<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use App\User;
use App\Service;
use App\Country;

class ServiceController extends Controller
{
    /**
     * Display a listing of the GlobalTest.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services=Service::all();	
    	$data['page_title']='Services';
        $data['services']=$services;
        return view('admin.services',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {		
    	$data['page_title']='Create Service';
		$data['page_type']='view';
        return view('admin.service_create_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$sprice = '';
		$request_arr = array();
		$base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
		
		$request_arr['sname'] = 'required';
		$request_arr['simage'] = 'required|image';
		$request_arr['user_dashboard_image'] = 'required|image';
		$request_arr['user_dashboard_desc'] = 'required';
		$request_arr['stype'] = 'required';
		$request_arr['sdesc'] = 'required';
		
		if($request['stype'] == 'paid'){
			$request_arr['sprice']='required';
		}
		$niceNames = array('sname' => 'Service Name',
   						   'simage' => 'Image',
						   'stype' => 'Type',
						   'sdesc' => 'Description',
						   'sprice' => 'Price');
        $validator = Validator::make($request->all(), $request_arr);
		$validator->setAttributeNames($niceNames);
		
        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }
		$sname=trim($request['sname']);
		$stype=trim($request['stype']);
		$sdesc=trim($request['sdesc']);
		$user_dashboard_desc=trim($request['user_dashboard_desc']);
		if($request['sprice']){
			$sprice=trim($request['sprice']);
		}
	$service_arr = array(
							'name'=>$sname,
							'type'=>$stype,
							'price'=>$sprice,
							'description'=>$sdesc,
							'currency_type'=>'EUR',
							'user_dashboard_desc'=>$user_dashboard_desc);
		$simage = $request->file('simage');
		$service_arr['image'] = Setting::saveUploadedImage($simage);
		$user_dashboard_image = $request->file('user_dashboard_image');
		$service_arr['user_dashboard_image'] = Setting::saveUploadedImage($user_dashboard_image);
		$service_obj = Service::create($service_arr);
        return redirect('admin/services')->with('status', 'Service has been created!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$service=Service::find($id);		
        $data['page_title']='Service';
		$data['page_type']='edit';
		$data['service']=$service;
        return view('admin.service_create_form',$data);
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
		$sprice = '';
		$request_arr = array();
		$base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
		
		$request_arr['sname'] = 'required';
		$request_arr['stype'] = 'required';
		$request_arr['sdesc'] = 'required';
		$request_arr['user_dashboard_desc']= 'required';
		if($request['stype'] == 'paid'){
			$request_arr['sprice']='required';
		}
		$niceNames = array('sname' => 'Service Name',
						   'stype' => 'Type',
						   'sdesc' => 'Description',
						   'sprice' => 'Price');
        $validator = Validator::make($request->all(), $request_arr);
		$validator->setAttributeNames($niceNames);
		
        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }
		$service =  Service::find($id);
		$sname=trim($request['sname']);
		$stype=trim($request['stype']);
		$sdesc=trim($request['sdesc']);
		$user_dashboard_desc=trim($request['user_dashboard_desc']);
		if($request['sprice']){
			$sprice=trim($request['sprice']);
		}
		$simage = $request->file('simage');
		$service_arr['image'] = Setting::saveUploadedImage($simage,$service->image);
		$user_dashboard_image = $request->file('user_dashboard_image');
		$service_arr['user_dashboard_image'] = Setting::saveUploadedImage($user_dashboard_image,$service->user_dashboard_image);
		$service_arr['name']=$sname;
		$service_arr['type']=$stype;
		$service_arr['price']=$sprice;
		$service_arr['description']=$sdesc;
		$service_arr['currency_type'] = 'EUR';
		$service_arr['user_dashboard_desc']=$user_dashboard_desc;
		
        $service_obj = $service->update($service_arr);
		return redirect('admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		// Delete Question
        $service = Service::find($id);
        $service->delete();		
        return redirect('admin/services')->with('status', 'Service deleted!');
    }
}
