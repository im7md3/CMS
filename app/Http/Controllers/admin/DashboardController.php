<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $posts_count=Post::count();
        $categories_count=Category::count();
        $comments_count=Comment::count();
        $users_count=User::count();
        return view('admin.index',compact(['categories_count','posts_count','users_count','comments_count']));
    }
}
