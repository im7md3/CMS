<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $
    }

    
    public function create()
    {
        return view('admin.pages.create');
    }

    
    public function store(PageRequest $request)
    {
        $page=Page::create($request->all());
        return back()->with(['success'=>'تم اضافة الصفحة بنجاح']);
    }


    public function show($slug)
    {
        $page=Page::whereSlug($slug)->first();
        return view('admin.pages.show',compact('page'));
    }


    public function edit(Page $page)
    {
        //
    }

    public function update(Request $request, Page $page)
    {
        //
    }

    public function destroy(Page $page)
    {
        //
    }
}
