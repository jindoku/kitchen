<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'max' => ':attribute không được quá ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'Mã thiết bị',
            'name' => 'Tên thiết bị',
            'category_id' => 'Nhóm hàng',
            'price' => 'Giá thành',
            'supplier' => 'Nhà cung cấp',
            'description' => 'Mô tả'
        ];
    }
}
