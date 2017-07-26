<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Blogs';
        $blogs = Blog::all();
        $data['blogs'] = $blogs;
        return view('admin.blogs',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['page_title'] = 'Add Blog';
        $data['page_type'] = 'create';
      return view('admin.blog_add',$data);
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
        $rules['description'] = 'required';
        $rules['image_file'] = 'required';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $blog_arr['title'] = $request->get('title');
        $blog_arr['description'] = $request->get('description');
        $blog_arr['created_by'] = Auth::user()->id;
        $image_file = $request->file('image_file');
        $blog_arr['image_file'] = Setting::saveUploadedImage($image_file);
        $blog_obj = Blog::create($blog_arr);
        return redirect('admin/blog/'.$blog_obj->id.'/show')->with('status', 'Blog Created Successfully')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::where('id',$id)->first();
        $data['page_title'] = 'Blog-'.$blog->title;
        $data['blog'] = $blog;
        $data['slug'] = $blog->id.$blog->title;
        return view('admin.blog_view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::where('id',$id)->first();
        $data['page_title'] = 'Edit Blog-'.$blog->title;
        $data['page_type'] = 'edit';
        $data['blog'] = $blog;
        return view('admin.blog_add',$data);
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

        $blog_obj = Blog::where('id',$id)->first();
        $rules['title'] = 'required';
        $rules['description'] = 'required';
        $rules['image_file'] = 'required';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $blog_arr['title'] = $request->get('title');
        $blog_arr['description'] = $request->get('description');
        $blog_arr['created_by'] = Auth::user()->id;
        $image_file = $request->file('image_file');
        $blog_arr['image_file'] = Setting::saveUploadedImage($image_file,$blog_obj->image_file);
        $blog_obj->update($blog_arr);
        return redirect('admin/blog/'.$blog_obj->id.'/show')->with('status', 'Blog Updated Successfully')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('admin/blogs')->with('status', 'Blog has been deleted!');

    }

}
