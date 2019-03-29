<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Slider;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SliderSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $data['page_title'] = 'All Sliders';
        $data['sliders'] = $sliders;
        return view('admin.sliders',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Add Slider Images';
        $data['page_type'] = 'create';
        return view('admin.slider_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules['image_file'] = 'required';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }


       /* $heading_1_arr = $request->get('heading_1');
        $k = 0;
        foreach($heading_1_arr as $heading_1) {
            $slider_arr[$k]['heading_1'] = $heading_1;
            $k++;
        }
        $heading_2_arr = $request->get('heading_2');
        $k = 0;
        foreach($heading_2_arr as $heading_2) {
            $slider_arr[$k]['heading_2'] = $heading_2;
            $k++;
        }*/
        $k = 0;
        $image_file_arr = $request->file('image_file');
        foreach($image_file_arr as $image_file) {
                $slider_arr[$k]['image_file'] = Setting::saveUploadedImage($image_file);
            $k++;
        }
        $slider_obj = Slider::insert($slider_arr);
        return redirect('admin/slider/settings')->with('status', 'Slider Added Successfully.');
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
        $data['page_title'] = 'Edit Slider Images';
        $data['page_type'] = 'edit';
        $slider = Slider::where('id',$id)->first();
        $data['slider'] = $slider;
        return view('admin.slider_add',$data);
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
        $slider_obj = Slider::where('id',$id)->first();

       /* $slider_arr['heading_1'] = $request->get('heading_1');
        $slider_arr['heading_2'] = $request->get('heading_2');*/
        $image_file = $request->file('image_file');
        $slider_arr['image_file'] =  Setting::saveUploadedImage($image_file, $slider_obj->image_file);
        $slider_obj->update($slider_arr);
        return redirect('admin/slider/settings')->with('status', 'Slider Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return redirect('admin/slider/settings')->with('status', 'Slider has been deleted!');

    }
}
