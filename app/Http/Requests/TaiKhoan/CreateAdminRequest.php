<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name'         =>  'required|min:5',
            'so_dien_thoai'     =>  'required|digits:10|unique:admins,so_dien_thoai',
            'email'             =>  'required|email|unique:admins,email',
            'password'          =>  'required|min:6|max:30',
            're_password'       =>  'required|same:password',
            'gioi_tinh'         =>  'required|numeric|min:0|max:2',
            'is_master'         =>  'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'required'      =>  ':attribute không được để trống',
            'max'           =>  ':attribute quá dài',
            'min'           =>  ':attribute quá ngắn',
            'exists'        =>  ':attribute không tồn tại',
            'unique'        =>  ':attribute đã tồn tại',
            'same'          =>  ':attribute và mật khẩu không giống',
            'digits'        =>  ':attribute phải là 10 sô',
        ];
    }
}
