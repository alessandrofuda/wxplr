<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Http\Request;
use App\User;
use App\VideoCategory;
use App\Tags;
use App\VideoTags;
use App\SkillDevelopmentVideos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinkla\Vimeo\Facades\Vimeo;


class SkillDevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skill_videos = SkillDevelopmentVideos::all();
        $data['page_title'] = 'Video Listing';
        $data['skill_videos'] = $skill_videos;

        return view('admin.skill_videos',$data);
    }

    public function categories()
    {
        $video_categories = VideoCategory::all();
        $data['page_title'] = 'Video Categories';
        $data['video_categories'] = $video_categories;

        return view('admin.video_categories',$data);
    }

    public function category()
    {
        $data['page_title'] = 'Add Video';
        $data['page_type'] = 'create';

        return view('admin.skill_video_category_add_form',$data);
    }

    public function category_save(Request $request)
    {
        $request_arr['category_name'] = 'required';
        $request_arr['category_desc'] = 'required';
        $validator = Validator::make($request->all(), $request_arr);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $category_array['category_name'] = trim($request['category_name']);
        $category_array['category_desc'] = $request['category_desc'];
        $category_obj = VideoCategory::create($category_array);

        return redirect('admin/skill_development/categories')->with('status', 'Video Category has been Added!');
    }

    public function category_edit($id)
    {
        $sk_video= VideoCategory::find($id);
        $data['page_title']='Edit Video Category';
        $data['page_type']='category_edit';
        $data['sk_video']=$sk_video;

        return view('admin.skill_video_category_add_form',$data);
    }

    public function category_update(Request $request, $id)
    {
        $request_arr['category_name'] = 'required';
        $request_arr['category_desc'] = 'required';
        $validator = Validator::make($request->all(), $request_arr);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $category_array['category_name'] = trim($request['category_name']);
        $category_array['category_desc'] = $request['category_desc'];
        $video_obj = VideoCategory::find($id)->update($category_array);

        return redirect('admin/skill_development/categories')->with('status', 'Video Category has been Updated!');
    }

    /**
     * Show the form for creating a new resource.
     *     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $video_categories = VideoCategory::all();
        $data['page_title'] = 'Add Video';
        $data['page_type'] = 'create';
        $data['video_categories'] = $video_categories;

        return view('admin.skill_video_add_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
        $video_arr = array();$request_arr = array();
        $request_arr['video_title'] = 'required';
		$request_arr['video_category'] = 'required';
        $request_arr['video_price'] = 'required';
        $request_arr['video_image'] = 'required|image';
		$request_arr['uploaded_video'] = 'required|mimes:mp4';
        $request_arr['description'] = 'required';
        $request_arr['preview_video'] = 'required|mimes:mp4';
        $validator = Validator::make($request->all(), $request_arr);

        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $video_title = trim($request['video_title']);
		$video_category = trim($request['video_category']);
        $video_type = trim($request['video_type']);		
        $video_arr['video_title'] = $video_title;
        $video_arr['video_category'] = $video_category;
        $video_price = $request['video_price'];
        $video_arr['price'] = $video_price;
        $video_arr['currency_type'] = 'EUR';
        $description = trim($request['description']);
        $video_arr['description'] = $description;
        $tag_arr['name']=trim($request['tag']);

		if($request->file('video_image')){
			$video_image = $request->file('video_image');

			if(!empty($video_image)) {
                // save image
				$video_img_original_name = $video_image->getClientOriginalName();

				if(file_exists($base_path.'/uploads/sdvideoimg/'.$video_img_original_name)){
					$video_img_name = time().'-'.$video_img_original_name;
				}
				else {
					$video_img_name=$video_img_original_name;
				}

				$video_img_name=str_replace(' ', '-', $video_img_name);
				$video_img_project_path ='/uploads/sdvideoimg/' . $video_img_name;
				$video_img_public_path = $base_path.'/uploads/sdvideoimg/';
				$video_image->move($video_img_public_path,$video_img_name);

			}

			$video_arr['video_image'] = $video_img_project_path;
		}

        if($request->file('uploaded_video')){
			$uploaded_video = $request->file('uploaded_video');
			
			if(!empty($uploaded_video)){ 
				// save image
				$video_original_name = $uploaded_video->getClientOriginalName();

                if(file_exists($base_path.'/uploads/sdvideo/'.$video_original_name)) {
					$video_name = time().'-'.$video_original_name;
				}else {
					$video_name=$video_original_name;
				}

				$video_name=str_replace(' ', '-', $video_name);
				$video_project_path ='/uploads/sdvideo/' . $video_name;
				$video_public_path = $base_path.'/uploads/sdvideo/';
				$uploaded_video->move($video_public_path,$video_name);

                try {
                    $vimeo = \App::make('vimeo');
                    $upload = $vimeo->upload($video_public_path . $video_name);
                    $video_arr['vimeo_path'] = $upload;
                    @unlink($video_public_path . $video_name);
                }catch (\Exception $e) {
                    Log::error($e->getMessage());
                    Log::error($e->getTraceAsString());
                    $video_arr['uploaded_video'] = $video_project_path;
                }

			}

		}

        if($request->file('preview_video')) {
            $preview_video = $request->file('preview_video');

            if(!empty($preview_video)){
                // save image
                $video_original_name = $preview_video->getClientOriginalName();

                if(file_exists($base_path.'/uploads/sdvideo/'.$video_original_name)){
                    $video_name = time().'-'.$video_original_name;
                }else {
                    $video_name=$video_original_name;
                }

                $video_name=str_replace(' ', '-', $video_name);
                $preview_video_project_path ='/uploads/sdvideo/' . $video_name;
                $preview_video_public_path = $base_path.'/uploads/sdvideo/';
                $preview_video->move($preview_video_public_path,$video_name);

                try {
                    $vimeo = \App::make('vimeo');
                    $upload = $vimeo->upload($preview_video_public_path . $video_name);
                    $video_arr['preview_vimeo_path'] = $upload;
                    @unlink($preview_video_public_path . $video_name);
                }catch (\Exception $e) {
                    Log::error($e->getMessage());
                    Log::error($e->getTraceAsString());
                    $video_arr['preview_video'] = $preview_video_project_path;
                }

                //echo $image_project_path;exit;
            }

        }
		//echo '<pre>';print_r($video_arr);exit;
        
        $video_obj = SkillDevelopmentVideos::create($video_arr);
        $tag = Tags::where('name',$tag_arr['name'])->first();

        if($tag == null) {
           $tag = Tags::create($tag_arr);
        }

        if($tag != null) {
            $video_tag_arr['tag_id'] = $tag->id;
            $video_tag_arr['video_id'] = $video_obj->id;
            VideoTags::create($video_tag_arr);
        }

        return redirect('admin/skill_development/videos')->with('status', 'Video has been Added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$sk_video=SkillDevelopmentVideos::find($id);
		$video_categories = VideoCategory::all();    
        $data['page_title']='Edit Video';
		$data['page_type']='edit';
		$data['video_categories'] = $video_categories;
		$data['sk_video']=$sk_video;

        return view('admin.skill_video_add_form',$data);
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
        $base_path=base_path();
		$base_path=str_replace("/wexsite", "", $base_path);
        
        $video_arr = array();$request_arr = array();
        $request_arr['video_title'] = 'required';
		$request_arr['video_category'] = 'required';
        $request_arr['video_price'] = 'required';
        $request_arr['video_image'] = 'image';
      //  $request_arr['uploaded_video'] = 'mimes:mp4';
        $request_arr['description'] = 'required';
      //  $request_arr['preview_video'] = 'required|mimes:mp4';
        $validator = Validator::make($request->all(), $request_arr);

        if ($validator->fails()) {
        	return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $video_obj = SkillDevelopmentVideos::find($id);
        $video_title = trim($request['video_title']);
		$video_category = trim($request['video_category']);
        $video_arr['video_title'] = $video_title;
        $video_arr['video_category'] = $video_category;
        $video_price = $request['video_price'];
        $video_arr['price'] = $video_price;
        $description = trim($request['description']);
        $video_arr['description'] = $description;
        $tag_arr['name']=trim($request['tag']);
        $old_video_image = $video_obj->video_image;

        if($request->file('video_image')){
			$video_image = $request->file('video_image');			

			if(!empty($video_image)){
				// save image
				$video_img_original_name = $video_image->getClientOriginalName();

                if(file_exists($base_path.'/uploads/sdvideoimg/'.$video_img_original_name)){
					$video_img_name = time().'-'.$video_img_original_name;
				}
				else {
					$video_img_name=$video_img_original_name;
				}

				$video_img_name=str_replace(' ', '-', $video_img_name);
				$video_img_project_path ='/uploads/sdvideoimg/' . $video_img_name;
				$video_img_public_path = $base_path.'/uploads/sdvideoimg/';
				$video_image->move($video_img_public_path,$video_img_name);
                @unlink($base_path.$old_video_image);
				//echo $image_project_path;exit;
			}

			$video_arr['video_image'] = $video_img_project_path;
		}

        $old_uploaded_video = $video_obj->uploaded_video;

        if($request->file('uploaded_video')) {
			$uploaded_video = $request->file('uploaded_video');
			
			if(!empty($uploaded_video)){ 
				// save image
				$video_original_name = $uploaded_video->getClientOriginalName();

                if(file_exists($base_path.'/uploads/sdvideo/'.$video_original_name)){
					$video_name = time().'-'.$video_original_name;
				}else {
					$video_name=$video_original_name;
				}

				$video_name=str_replace(' ', '-', $video_name);
				$video_project_path ='/uploads/sdvideo/' . $video_name;
				$video_public_path = $base_path.'/uploads/sdvideo/';
                @unlink($base_path.$old_uploaded_video);
				$uploaded_video->move($video_public_path,$video_name);

                try {
                    $vimeo = \App::make('vimeo');
                    $upload = $vimeo->upload($video_public_path . $video_name);
                    $video_arr['vimeo_path'] = $upload;
                    @unlink($video_public_path . $video_name);
                }catch (\Exception $e) {
                    Log::error($e->getMessage());
                    Log::error($e->getTraceAsString());
                    $video_arr['uploaded_video'] = $video_project_path;
                }

			}

		}

        $old_preview_video = $video_obj->preview_video;

        if($request->file('preview_video')){
            $preview_video = $request->file('preview_video');

            if(!empty($preview_video)){
                // save image
                $video_original_name = $preview_video->getClientOriginalName();

                if(file_exists($base_path.'/uploads/sdvideo/'.$video_original_name)){
                    $video_name = time().'-'.$video_original_name;
                }else {
                    $video_name=$video_original_name;
                }

                $video_name=str_replace(' ', '-', $video_name);
                $preview_video_project_path ='/uploads/sdvideo/' . $video_name;
                $preview_video_public_path = $base_path.'/uploads/sdvideo/';
                $preview_video->move($preview_video_public_path,$video_name);
                @unlink($base_path.$old_preview_video);

                try {
                    $vimeo = \App::make('vimeo');
                    $upload = $vimeo->upload($preview_video_public_path . $video_name);
                    $video_arr['preview_vimeo_path'] = $upload;
                    @unlink($preview_video_public_path . $video_name);
                }catch (\Exception $e) {
                    Log::error($e->getMessage());
                    Log::error($e->getTraceAsString());
                    $video_arr['preview_video'] = $preview_video_project_path;
                }

            }
            
        }

		//echo '<pre>';print_r($video_arr);exit;
        $video_arr['currency_type'] = 'EUR';

        $video_obj->update($video_arr);
        $tag = Tags::where('name',$tag_arr['name'])->first();

        if($tag == null) {
            $tag = Tags::create($tag_arr);
        }

        if($tag != null) {
            $video_tag_arr['tag_id'] = $tag->id;
            $video_tag_arr['video_id'] = $video_obj->id;
            VideoTags::create($video_tag_arr);
        }

        return redirect('admin/skill_development/videos')->with('status', 'Video has been Updated!');
    }

    public function auto_complete(Request $request) {
        $query = $request->get('term','');

        $tags=Tags::where('name','LIKE','%'.$query.'%')->get();

        $data = array();

        foreach ($tags as $tag) {
            $data[]=array('value'=>$tag->name,'id'=>$tag->id);
        }

        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_category($id)
    {
        $video_obj = VideoCategory::find($id);
        $video_obj->delete();

        return redirect('admin/skill_development/categories')->with('status', 'Video Category deleted!');
    }

    public function destroy($id)
    {
        $video_obj = SkillDevelopmentVideos::find($id);
        $video_obj->delete();		

        return redirect('admin/skill_development/videos')->with('status', 'Video deleted!');
    }

    public function show($id) {
        $video = SkillDevelopmentVideos::find($id);
        $data['page_title'] = 'Video -'.$video->video_title;
        $data['video'] = $video;

        return view('admin.video_view', $data);
    }

}
