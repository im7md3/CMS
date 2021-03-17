<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class permissionController extends Controller
{
    public function index(){
        $permissions=Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }
}
