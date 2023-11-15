<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonHangRequest extends FormRequest
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
            'ten_nguoi_nhan'            =>  'required|min:2|max:20',
            'sdt_nguoi_nhan'            =>  'required|digits:10|',
            'email_nguoi_nhan'          =>  'required|email|',
            'dia_chi_nguoi_nhan'                   =>  'required|min:6',
            'phi_van_chuyen'                   =>  'required',
            'loai_thanh_toan'                   =>  'required',


        ];
    }
    public function messages()
    {
        return [
            'required'      =>  ':attribute đừng để trống',
            'max'           =>  ':attribute quá dài',
            'min'           =>  ':attribute quá ngắn',
            'digits'        =>  ':attribute phải là 10 sô',
        ];
    }
    public function attributes()
    {
        return [
            'ten_nguoi_nhan'            =>  'Họ và tên',
            'sdt_nguoi_nhan'            =>  'Số điện thoại',
            'email_nguoi_nhan'          =>  'Email',
            'dia_chi_nguoi_nhan'        =>  'Địa chỉ',
            'phi_van_chuyen'        =>  'Phí ship',

            'loai_thanh_toan'        =>  'Hình thức thanh toán',

        ];
    }
}
