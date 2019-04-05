<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Package;
use App\SkillDevelopmentVideos;
use App\UserPackage;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Packages';
        $packages = Package::all();
        $data['packages'] = $packages;
        return view('admin.package_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create Package';
        $model = new Package();
        $skills = $model->getSkillOptions();
        $videos = SkillDevelopmentVideos::all();
        $events = Event::all();
        $data['events'] = $events;
        $data['videos'] = $videos;
        $data['skills'] = $skills;
        return view('admin.package_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules['title'] = 'required';
        $rules['skills'] = 'required';
        $rules['count'] = 'required';
        $rules['price'] = 'required';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $package_arr['title'] = $request->get('title');
        $package_arr['description'] = $request->get('description');
        $package_arr['skills'] = ltrim($request->get('skills'), '-');
        $package_arr['count'] = ltrim($request->get('count'), '-');
        $package_arr['price'] = $request->get('price');
        $package_arr['items'] = ltrim($request->get('items'),'-');
        $package_arr['currency_type'] = 'EUR';
        $package_obj = Package::create($package_arr);
        return redirect('admin/package/list')->with('status', 'Package created successfully');
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
       $package = Package::where('id',$id)->first();
       if(!UserPackage::where('package_id',$id)->exists()) {
           $package->delete();
           return redirect('admin/package/list')->with('status', 'Package deleted successfully');
       }
        return redirect('admin/package/list')->with('status', 'Used Package can not be deleted');
    }
}
