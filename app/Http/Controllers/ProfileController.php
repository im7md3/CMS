<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
/* use App\Profile; */
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{

     public function getByUser($id){
        $user=User::with(['posts'=>function($query){
            $query->whereApproved(1)->get();
        }])->find($id);
        return view('user.profile',compact('user'));
    }

    public function getCommentsByUser($id){
        $user=User::with(['comments.post'])->find($id);
        return view('user.profile',compact('user'));
    }

    public function settings(){
        $user=User::find(auth()->id());
        return view('user.settings',compact('user'));
    } 

    public function updateProfile(ProfileRequest $request){
        /* try{
            auth()->user()->update($request->only(['name','email']));
            if($request->has('avatar_file')){
                if( auth()->user()->avatar){
                    $default=Str::after(auth()->user()->avatar, 'avatars/');
                    $image=Str::after(auth()->user()->avatar, 'public/'); 
                    if($image != $default){
                        unlink($image);
                    }
                }
                $file_path=userImageUpload($request->avatar_file);
                auth()->user()->updateOrCreate(['user_id'=>auth()->id()],
                ([
                    'website' => $request->website,
                    'bio' => $request->bio,
                    'avatar'=> $file_path
                    ]));

            }else{
                auth()->user()->updateOrCreate(['user_id'=>auth()->id()],$request->only(['website','bio']));
            }
            return redirect()->back()->with(['success'=>'تم تعديل البيانات بنجاح']);
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails'=>'حدث خطأ ما الرجاء المحاولة لاحقا']);
        } */
        try{
            if($request->has('avatar_file')){
                if( auth()->user()->avatar){
                    $image=Str::after(auth()->user()->avatar, 'public/'); 
                    if($image != 'images/avatars/avatar.png'){
                        unlink($image);
                    }
                }
                $file_path=userImageUpload($request->avatar_file);
                auth()->user()->update([
                    'name'=>$request->name,
                    'email' =>$request->email,
                    'avatar'=>$file_path,
                    'website'=>$request->website,
                    'bio'=>$request->bio
                ]);
            }else{
                auth()->user()->update([
                    'name'=>$request->name,
                    'email' =>$request->email,
                    'website'=>$request->website,
                    'bio'=>$request->bio
                ]);
            }
            return redirect()->back()->with(['success'=>'تم تعديل البيانات بنجاح']);
        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with(['fails'=>'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    } 
}
