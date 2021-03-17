<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::paginate(10);
            $active_users = 'text-white';
            $roles = Role::all();
            return view('admin.users.index', compact(['users', 'active_users', 'roles']));
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }


    public function create()
    {
        try {
            $active_users = 'text-white';
            return view('admin.users.create', compact('active_users'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }


    public function store(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id
            ]);
            return redirect()->route('user.index')->with(['success' => 'تم إضافة المستخدم بنجاح']);
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        try {
            $user->update(['role_id' => $request->role]);
            return redirect()->route('user.index')->with(['success' => 'تم تعديل الدور بنجاح']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            $posts = $user->posts()->where('user_id', $user->id)->get();
            foreach ($posts as $post) {
                $post->comments()->delete();
                $image = Str::after($post->image_path, 'public/');
                unlink($image);
            }
            $imageUser = Str::after($user->avatar, 'public/');
            if ($imageUser != 'images/avatars/default.png'){
                unlink($imageUser);
            }
            $user->posts()->delete();
            $user->delete();
            DB::commit();
            return redirect()->route('user.index')->with(['success' => 'تم حذف المستخدم بنجاح']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['fails' => 'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }
}
