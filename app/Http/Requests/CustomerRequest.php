<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'fullname' => 'required|max:255',
            'phone' => 'required|max:20',
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
            'fullname' => 'Tên khách hàng',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'birtday' => 'Ngày sinh',
            'sex' => 'Giới tính',
            'address' => 'Địa chỉ',
        ];
    }
}
