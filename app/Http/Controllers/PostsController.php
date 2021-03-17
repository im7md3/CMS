<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::with('user:id,name')->approved()->paginate(10);
        return view('index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(PostRequest $request)
    {
        try {
            if ($request->has('image_path')) {
                $file_path = ImageUpload($request->image_path);
            }
            $post = Post::create([
                'title' => $request->title,
                'image_path' => $file_path,
                'category_id' => $request->category_id,
                'body' => $request->body,
                'user_id' => auth()->id()
            ]);
            return redirect()->route('posts.index')->with(['success' => 'تم اضافة المنشور بنجاح']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }


    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        try{
            if (!Gate::allows('edit-post', $post)) {
                abort(403);
            }
            return view('posts.edit', compact('post'));
        }catch(\Exception $e){
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
        
    }


    public function update(PostRequest $request, Post $post)
    {

        try {
            if ($request->has('image_path')) {
                $image = Str::after($post->image_path, 'public/');
                unlink($image);
                $file_path = ImageUpload($request->image_path);
                $post->update([
                    'title' => $request->title,
                    'image_path' => $file_path,
                    'category_id' => $request->category_id,
                    'body' => $request->body,
                ]);
            } else {
                $post->update([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'body' => $request->body,
                ]);
            }
            return redirect()->route('posts.index')->with(['success' => 'تم تعديل المنشور بنجاح']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }


    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }
        try {
            $post->comments()->delete();
            $post->delete();
            $image = Str::after($post->image_path, 'public/');
            unlink($image);
            return redirect('/')->with(['success' => 'تم حذف المنشور بنجاح']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    public function getByCategory($id, $slug)
    {

        try {
            $posts = Post::with('user:id,name')->where('category_id', $id)->approved()->paginate();
            return view('index', compact('posts'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    public function search(Request $request)
    {
        try {
            $posts = Post::where('title', 'like', '%' . $request->keyword . '%')->with('user:id,name')->approved()->paginate(10);
            return view('index', compact('posts'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }
}
