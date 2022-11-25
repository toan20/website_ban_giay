<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slide_1'   => 'unique:slide_1,slide_2,slide_3',
            'slide_2'   => 'unique:slide_1,slide_2,slide_3',
            'slide_3'   => 'unique:slide_1,slide_2,slide_3',
        ];
    }

    public function messages()
    {
        return [
            'unique'        =>  ':attribute đã tồn tại trong hệ thống',
        ];
    }


}
