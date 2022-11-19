<?php

namespace App\Http\Requests\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaiKhoanRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                =>  'required|exists:admins,id',
            'full_name'         =>  'required|min:5',
            'so_dien_thoai'     =>  'required|digits:10|unique:admins,so_dien_thoai,' . $this->id,
            'email'             =>  'required|email|unique:admins,email,' . $this->id,
            'password'          =>  'nullable|min:6|max:30',
            're_password'       =>  'nullable|same:password',
            'gioi_tinh'         =>  'required|numeric|min:0|max:2',
            'is_master'         =>  'required|boolean',
            'is_block'          =>  'required|boolean',
        ];
    }
}
