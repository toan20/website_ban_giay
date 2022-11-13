<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSanPhamRequest extends FormRequest
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
            'id'                =>      'required|exists:san_phams,id',
            'ma_san_pham'               => 'required|min:5|unique:san_phams,ma_san_pham',
            'ten_san_pham'              => 'required|min:5|unique:san_phams,ten_san_pham',
            'slug_san_pham'             => 'required|min:5|unique:san_phams,slug_san_pham',
            'is_open'                   => 'required|boolean',
            'don_gia_ban'               => 'required|numeric|min:0',
            'don_gia_khuyen_mai'        => 'nullable|numeric|max:' . $this->don_gia_ban,
            'danh_muc_id'               => 'required|exists:danh_mucs,id',
            'hinh_anh'                  => 'required',
            'mo_ta_ngan'                => 'required',
            'mo_ta_chi_tiet'            => 'required',
        ];
    }
    public function messages()
    {
        return [
            'id.required'   => 'Danh mục không được để trống',
            'id.exists'     => 'Danh mục không tồn tại trong hệ thống',
            'required'      =>  ':attribute không được để trống',
            'min'           =>  ':attribute quá nhỏ/ngắn',
            'boolean'       =>  ':attribute không phải Yes/No',
            'numeric'       =>  ':attribute không phải là số',
            'max'           =>  ':attribute quá lớn/dài',
            'exists'        =>  ':attribute không tồn tại',
            'unique'        =>  ':attribute đã tồn tại trong hệ thống',
        ];
    }
}
