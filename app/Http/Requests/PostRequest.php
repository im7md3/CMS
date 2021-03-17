<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'required',
            'title'=>'required|string',
            'body'=>'required|string',

        ];
    }

    public function messages()
    {
        return [
            'category_id.required'=>'يجب تحديد القسم',
            'title.required'=>'يجب ادخال العنوان',
            'body.required'=>'يجب ادخال محتوى الموضوع',
        ];
    }
}
