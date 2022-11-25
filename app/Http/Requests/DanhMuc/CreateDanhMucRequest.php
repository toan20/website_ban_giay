<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class CreateDanhMucRequest extends FormRequest
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
            'ma_danh_muc'       =>  'required|min:3|unique:danh_mucs,ma_danh_muc',
            'ten_danh_muc'      =>  'required|min:3',
            'slug_danh_muc'     =>  'required|min:3',
            'is_open'           =>  'required|boolean',
            'id_danh_muc_cha'   =>  'required',
        ];
    }
    public function messages()
    {
        return [
            'ma_danh_muc.required'      => 'Mã danh mục không thể để trống',
            'ten_danh_muc.required'     => 'Tên danh mục không thể để trống',
            'slug_danh_muc.required'    => 'Slug danh mục không thể để trống',
            'is_open.required'          => 'Tình trạng không thể để trống',
            'id_danh_muc_cha.required'  => 'Danh mục cha không thể để trống',
            'ma_danh_muc.min'           => 'Mã danh mục phải từ 5 ký tự trở lên',
            'ten_danh_muc.min'          => 'Tên danh mục phải từ 5 ký tự trở lên',
            'slug_danh_muc.min'         => 'Slug danh mục phải từ 5 ký tự trở lên',
            'ma_danh_muc.unique'        => 'Mã danh mục đã tồn tại',
            'is_open.boolean'           => 'Tình trạng chỉ được chọn Yes/No',
        ];
    }
}
