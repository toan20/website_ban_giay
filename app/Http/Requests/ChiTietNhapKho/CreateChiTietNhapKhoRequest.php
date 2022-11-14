<?php

namespace App\Http\Requests\ChiTietNhapKho;

use Illuminate\Foundation\Http\FormRequest;

class CreateChiTietNhapKhoRequest extends FormRequest
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
            'id_san_pham'   =>  'required|exists:san_phams,id',
        ];
    }
    public function messages()
    {
        return [
            'id_san_pham.exists'        => 'Sản phẩm không tồn tại!',
            'id_san_pham.required'      => 'Sản phẩm không tồn tại!',
        ];
    }
}
