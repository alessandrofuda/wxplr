<?php

namespace App\Http\Controllers;

use App\Blog;
use App\MetaTags;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends CustomBaseController
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
        $meta_tag = MetaTags::where('page_type', MetaTags::PAGE_TYPE_BLOG)->first();
        $data['meta_tag'] = $meta_tag;
        return view('front.blogs',$data);
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
        $blog = Blog::where('id',$id)->first();
        $data['page_title'] = 'Blog-'.$blog->title;
        $data['blog'] = $blog;
        $slug = md5($blog->id.$blog->title);
        $data['slug'] = $slug;
        $data['blogs'] = Blog::take(4)->get();
        $meta_tag = MetaTags::where('page_type', MetaTags::PAGE_TYPE_BLOG)->first();
        $data['meta_tag'] = $meta_tag;
        return view('front.blog_view',$data);
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
