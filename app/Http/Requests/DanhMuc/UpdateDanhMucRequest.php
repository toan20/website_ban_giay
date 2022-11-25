<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDanhMucRequest extends FormRequest
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
            'id'                =>  'required|exists:danh_mucs,id',
            'ma_danh_muc'       =>  'required|min:2|',
            'ten_danh_muc'      =>  'required|min:2',
            'slug_danh_muc'     =>  'required|min:2',
            'is_open'           =>  'required|boolean',
            'id_danh_muc_cha'   =>  'required',
        ];
    }
    public function messages()
    {
        return [
            'id.required'               => 'Danh mục không được để trống',
            'id.exists'                 => 'Danh mục không tồn tại trong hệ thống',
            'ma_danh_muc.required'      => 'Mã danh mục không thể để trống',
            'ten_danh_muc.required'     => 'Tên danh mục không thể để trống',
            'slug_danh_muc.required'    => 'Slug danh mục không thể để trống',
            'is_open.required'          => 'Tình trạng không thể để trống',
            'id_danh_muc_cha.required'  => 'Danh mục cha không thể để trống',
            'ma_danh_muc.min'           => 'Mã danh mục phải từ 2 ký tự trở lên',
            'ten_danh_muc.min'          => 'Tên danh mục phải từ 2 ký tự trở lên',
            'slug_danh_muc.min'         => 'Slug danh mục phải từ 2 ký tự trở lên',
            'ma_danh_muc.unique'        => 'Mã danh mục đã tồn tại',
            'is_open.boolean'           => 'Tình trạng chỉ được chọn Yes/No',
        ];
    }
}
