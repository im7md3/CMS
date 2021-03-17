<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getAvatarAttribute($value)
    {
        return asset($value);
    }
}
