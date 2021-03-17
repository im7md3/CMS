<?php


function uniqueSlug($slug, $table)
{


    $items = \DB::table($table)->select('slug')->whereRaw("slug like '$slug%'")->get();

    $count = count($items) + 1;

    return $slug . '-' . $count;
}




function slug($str)
{
    $string = preg_replace("/[^a-z0-9_\s۰۱۲۳۴۵۶۷۸۹يءاأإآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنوهی]/u", '', $str);

    $string = preg_replace("/[_\s]+/", ' ', $string);

    $string = preg_replace("/[_\s]/", '-', $string);

    return $string;
}




function ImageUpload($img)
{
    $img_height = 300;
    $img_width = 700;
    $img_name = time() . '-' . $img->getClientOriginalName();
    Image::make($img)->resize($img_width, $img_height)->save(public_path('images/posts/' . $img_name));
    return "images/posts/" . $img_name;
}

function userImageUpload($img)
{
    $img_height = 240;
    $img_width = 240;
    $img_name = time() . '-' . $img->getClientOriginalName();
    Image::make($img)->resize($img_width, $img_height)->save(public_path('images/avatars/' . $img_name));
    return "images/avatars/" . $img_name;
}
