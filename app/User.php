<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{

    protected $guarded = [
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /* public function profile(){
        return $this->hasOne(Profile::class);
    } */

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(){
        return $this->role->id==1;
    }

    public function hasAllow($permission){
        $role=$this->role()->first();
        return $role->permission()->whereName($permission)->first() ? true:false;
    }
}
