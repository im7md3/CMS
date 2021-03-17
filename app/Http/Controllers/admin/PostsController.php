<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts=Post::with(['user','category'])->get();
        return view('admin.posts.all',compact('posts'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Post $post)
    {
        //
    }


    
    public function edit(Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    
    public function update(PostRequest $request, Post $post)
    {
        try{
            if(!$request->has('approved')){
                $request->request->add(['approved'=>0]);
            }else{
                $request->request->add(['approved'=>1]);
            }
            if($request->has('image')){
                $image=Str::after($post->image_path, 'storage/'); 
                Storage::disk('public')->delete($image);
                $file_path=ImageUpload($request->image);
                $post->update([
                    'title' => $request->title,
                    'image_path' => $file_path,
                    'category_id' => $request->category_id,
                    'body'=>$request->body,
                    'slug'=>$request->slug,
                    'approved'=>$request->approved,
                ]);
            }else{
                $post->update([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'body'=>$request->body,
                    'slug'=>$request->slug,
                    'approved'=>$request->approved,
                ]);
            }
            return redirect()->route('post.index')->with(['success'=>'تم تعديل المنشور بنجاح']);

        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails'=>'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    public function destroy(Post $post)
    {
        try{
            $post->comments()->delete();
            $post->delete();
            $image=Str::after($post->image_path, 'storage/'); 
            Storage::disk('public')->delete($image);
            return redirect()->back()->with(['success'=>'تم حذف المنشور بنجاح']);
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails'=>'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }
}
