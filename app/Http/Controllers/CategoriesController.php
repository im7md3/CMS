<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.category', compact('categories'));
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
        try {
            Category::create(['title' => $request->title]);
            return redirect()->back()->with(['success' => 'تم اضافة القسم بنجاح']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category->update(['title' => $request->title]);
            return redirect()->back()->with(['success' => 'تم تعديل القسم بنجاح']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();
            $posts = $category->posts()->where('category_id',$category->id)->get();
            foreach ($posts as $post) {
                $post->comments()->delete();
                $image = Str::after($post->image_path, 'public/');
                unlink($image);
            }
            $category->posts()->delete();
            $category->delete();
            DB::commit();
            return redirect()->back()->with(['success' => 'تم حذف القسم بنجاح']);
        } catch (\Exception $e) {
            return $e;
            DB::rollback();
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }
}
