<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'code' => 'required|max:255',
            'customer_id' => 'required',
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
            'code' => 'Mã hóa đơn',
            'customer_id' => 'Khách hàng',
            'note' => 'Ghi chú'
        ];
    }
}
