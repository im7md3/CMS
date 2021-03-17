<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded=[];

    public function Roles(){
        return $this->belongsToMany(Role::class);
    }
}
