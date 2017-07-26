<?php

namespace App\Http\Controllers;

use App\PreferentialCodes;
use App\Tags;
use App\UserSubscription;
use App\VideoCategory;
use Illuminate\Http\Request;
use Validator;
use App\SkillDevelopmentVideos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserSubscriptionController extends CustomBaseController
{
    public function my(Request $request){
        $user_id = Auth::user()->id;
        $data['page_title'] = 'My Videos';
        $subscriptions = UserSubscription::where('user_id',$user_id)->get();
        $data['videos'] = [];
        $current_video = [];
        if($request->get('video_id') != '') {
            $current_video = SkillDevelopmentVideos::where('id',$request->get('video_id'))->first();
        }
        $data['current_video'] = $current_video;
        foreach($subscriptions as $subscription) {
            if($subscription->end_date >= date('Y-m-d')) {
                $video = SkillDevelopmentVideos::where('id',$subscription->video_id)->first();
                if($video != null) {
                    $data['videos'][] = $video;
                }
            }
        }
        return view('client.my_videos',$data);
    }
    public function index()
    {
        //
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
