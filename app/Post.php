<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getImagepathAttribute($value){
        return asset($value);
    }

    public function scopeApproved($query){
        return $query->whereApproved(true)->latest();
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title']= $value;
        $this->attributes['slug']= uniqueSlug($value,'posts');
    }

}
