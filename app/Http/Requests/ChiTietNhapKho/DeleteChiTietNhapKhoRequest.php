<?php

namespace App\Http\Requests\ChiTietNhapKho;

use Illuminate\Foundation\Http\FormRequest;

class DeleteChiTietNhapKhoRequest extends FormRequest
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
            'id'    =>  'required|exists:chi_tiet_nhap_khos,id',
        ];
    }
    public function messages()
    {
        return [
            'id.exists'        => 'Sản phẩm không tồn tại!',
            'id.required'      => 'Sản phẩm không tồn tại!',
        ];
    }
}
