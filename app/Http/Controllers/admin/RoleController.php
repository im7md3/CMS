<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(Request $request){
        try{
            Role::find($request->role_id)->permission()->sync($request->permission);
            return redirect()->back()->with(['success'=>'تم تحديد الصلاحيات بنجاح']);
        }catch(\Exception $e){
            return redirect()->back()->with(['fails'=>'حدث خطأ ما الرجاء المحاولة لاحقا']);
        }
    }

    public function getByRole(Request $request){
        $permissions=Role::find($request->id)->permission()->pluck('permission_id');
        return $permissions;
    }
}
