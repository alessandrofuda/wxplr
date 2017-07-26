<?php

namespace App\Http\Controllers\Admin;

use App\MetaTags;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MetaTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = MetaTags::all();
        $data['page_title'] = 'All Meta Tags';
        $data['tags'] = $tags;
        return view('admin.meta_tags',$data);
    }
    public function create()
    {
        $data['page_title'] = 'Add Meta Tag';
        $data['page_type'] = 'create';
        $data['pageTypes'] = MetaTags::getPageTypeOptions();
        return view('admin.meta_tags_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$rules['title'] = 'required';*/
        $rules[''] = '';
        /*$rules['content'] = 'required';*/
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $tag_arr['name'] = $request->get('name');
        $tag_arr['page_type'] = $request->get('page_type');
        $tag_arr['content'] = $request->get('meta_description');
        $tag_arr['title'] = $request->get('title');
        $tag_arr['meta_title'] = $request->get('meta_title');
        $tag_arr['meta_description'] = $request->get('meta_description');

        $tag_obj = MetaTags::create($tag_arr);
        return redirect('admin/meta-tags')->with('status', 'Meta Tag Created Successfully')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = MetaTags::where('id',$id)->first();
        $data['page_title'] = 'MetaTags-'.$tag->title;
        $data['tag'] = $tag;
        return view('admin.meta_tags_view',$data);
    }

    public function edit($id)
    {
        $tag = MetaTags::where('id',$id)->first();
        $data['page_title'] = 'Edit MetaTag-'.$tag->title;
        $data['page_type'] = 'edit';
        $data['tag'] = $tag;
        $data['pageTypes'] = MetaTags::getPageTypeOptions();
        return view('admin.meta_tags_add',$data);
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
        $MetaTag_obj = MetaTags::where('id',$id)->first();
        $rules = [];
       /// $rules['name'] = 'required';
      //  $rules['content'] = 'required';
       // $rules['page_type'] = 'required';
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $MetaTag_arr['name'] = trim($request->get('name'));
        $MetaTag_arr['page_type'] = trim($request->get('page_type'));
        $MetaTag_arr['content'] = trim($request->get('meta_description'));
        $MetaTag_arr['title'] = $request->get('title');
        $MetaTag_arr['meta_title'] = $request->get('meta_title');
        $MetaTag_arr['meta_description'] = $request->get('meta_description');
        $MetaTag_obj->update($MetaTag_arr);
        return redirect('admin/meta-tags')->with('status', 'Meta Tags Updated Successfully')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $MetaTags = MetaTags::find($id);
        $MetaTags->delete();
        return redirect('admin/meta-tags')->with('status', 'Meta Tags has been deleted!');
    }


}
