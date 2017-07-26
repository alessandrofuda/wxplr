<?php

namespace App\Http\Controllers;

use App\ConsultantProfile;
use App\Event;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends CustomBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Events';
        $events = Event::all();
        $data['events'] = $events;
        return view('admin.events',$data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::where('id',$id)->first();
        $data['page_title'] = 'Event-'.$event->name;
        $data['event'] = $event;
        $data['slug'] = $event->id.$event->name;
        return view('client.event_view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id',$id)->first();
        $data['page_title'] = 'Edit Event-'.$event->name;
        $data['page_type'] = 'edit';
        $data['event'] = $event;
        $consultants = ConsultantProfile::all();
        $data['consultants'] = $consultants;
        return view('admin.event_add',$data);
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

        $event_obj = Event::where('id',$id)->first();
        $rules['name'] = 'required';
        $rules['price'] = 'required:integer';
        $rules['description'] = 'required';
        $rules['event_date'] = 'required';
        $rules['consultant_id'] = 'required';
        $validator = Validator::make($request->all(),$rules);
      
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        
        $event_arr['name'] = $request->get('name');
        $event_arr['price'] = $request->get('price');
        $event_arr['description'] = $request->get('description');
        $event_arr['consultant_id'] = $request->get('consultant_id');
        $event_arr['event_date'] = date('Y-m-d',strtotime($request->get('event_date')));
        $event_arr['created_by'] = Auth::user()->id;
        $event_arr['currency_type'] = 'EUR';
        $image_file = $request->file('image_file');
        $event_arr['image_file'] = Setting::saveUploadedImage($image_file,$event_obj->image_file);
        $event_obj->update($event_arr);
        
        return redirect('admin/events')->with('status', 'Event Updated Successfully')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect('admin/events')->with('status', 'Event has been deleted!');

    }
}
