<?php

namespace App\Http\Controllers\Admin;

use App\ConsultantBooking;
use App\ConsultantProfile;
use App\Event;
use App\EventBooking;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Add Event';
        $data['page_type'] = 'create';
        $consultants = ConsultantProfile::all();
        $data['consultants'] = $consultants;
        return view('admin.event_add',$data);
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
        $rules['price'] = 'required:integer';
        $rules['description'] = 'required';
        $rules['event_date'] = 'required';
        $rules['consultant_id'] = 'required';
        $rules['event_start'] = 'required';
        $rules['event_end'] = 'required';
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        if($request->get('event_start') > $request->get('event_end')) {
            return redirect()->back()->withInput()->with('error', 'Event Start time should be less then event end time');
        }

        $event_start_date =  date('Y-m-d',strtotime($request->get('event_date'))).' '.date('H:i:s',strtotime($request->get('event_start')));

        $event_start_date_utc = Setting::dateUtc($event_start_date);
        $event_start_time_utc = Setting::dateUtc($event_start_date, true);

        $event_end_date =  date('Y-m-d',strtotime($request->get('event_date'))).' '.date('H:i:s',strtotime($request->get('event_end')));

        $event_end_date_utc = Setting::dateUtc($event_end_date);
        $event_end_time_utc = Setting::dateUtc($event_end_date,true);

        $event_arr['name'] = $request->get('name');
        $event_arr['price'] = $request->get('price');
        $event_arr['description'] = $request->get('description');
        $event_arr['consultant_id'] = $request->get('consultant_id');
        $event_arr['event_date'] = $event_start_date_utc;
        $event_arr['event_start'] = $event_start_time_utc;
        $event_arr['event_end'] = $event_end_time_utc;
        $event_arr['created_by'] = Auth::user()->id;
        $event_arr['currency_type'] = 'EUR';
        $image_file = $request->file('image_file');
        $event_arr['image_file'] = Setting::saveUploadedImage($image_file);
        $event_obj = Event::create($event_arr);
        $event_obj->addWebinar();
        return redirect('admin/events')->with('status', 'Event Created Successfully')->withInput();
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

        return view('admin.event_view',$data);
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
        $rules['event_start'] = 'required';
        $rules['event_end'] = 'required';
        $rules['consultant_id'] = 'required';
        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        if($request->get('event_start') > $request->get('event_end')) {
            return redirect()->back()->withInput()->with('error', 'Event Start time should be less then event end time');
        }

        $event_start_date =  date('Y-m-d',strtotime($request->get('event_date'))).' '.date('H:i:s',strtotime($request->get('event_start')));

        $event_start_date_utc = Setting::dateUtc($event_start_date);
    
        $event_start_time_utc = Setting::dateUtc($event_start_date, true);
        $event_start_time_utc = date('H:i:s',strtotime($event_start_time_utc) );
        $event_end_date =  date('Y-m-d',strtotime($request->get('event_date'))).' '.date('H:i:s',strtotime($request->get('event_end')));

        $event_end_date_utc = Setting::dateUtc($event_end_date);
        $event_end_time_utc = Setting::dateUtc($event_end_date,true);
        $event_end_time_utc = date('H:i:s',strtotime($event_end_time_utc) );

        $event_arr['name'] = $request->get('name');
        $event_arr['price'] = $request->get('price');
        $event_arr['description'] = $request->get('description');
        $event_arr['consultant_id'] = $request->get('consultant_id');
        $event_arr['event_date'] = $event_start_date_utc;
        $event_arr['event_start'] = $event_start_time_utc;
        $event_arr['event_end'] = $event_end_time_utc;
        $event_arr['created_by'] = Auth::user()->id;
        $event_arr['currency_type'] = 'EUR';
        $image_file = $request->file('image_file');
        $event_arr['image_file'] = Setting::saveUploadedImage($image_file,$event_obj->image_file);
        $event_obj->update($event_arr);

        if($event_obj->webinar_key == null) {
            if($event_obj->addWebinar()) {
                $event_obj->addCoOrganizer();
            }
        }else{
            $event_obj->updateWebinar();
        }


        if($event_obj->joinLink == null) {
            $event_obj->addCoOrganizer();
        }

        return redirect('admin/events')->with('status', 'Event Updated Successfully')->withInput();
    }

    public function booking_view(Request $request, $id)
    {
        $booking = EventBooking::find($id);

        $booking->registerWebinar();
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
        $bookings = EventBooking::where('event_id', $id)->get();

        foreach ($bookings as $booking) {
            $booking->removeRegistrant();
            $booking->delete();
        }

        $event->cancelWebinar();
        $event->delete();
        return redirect('admin/events')->with('status', 'Event has been deleted!');
    }
}
