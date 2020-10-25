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
    protected $attr = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $request = $this->request;
        $rules =  [
            'code' => 'required|max:255',
            'customer_id' => 'required',
            'staff_id' => 'required',
            'total_row' => 'required|numeric|min:1',
        ];

        $rowProduct = $request->get('total_row');
        for ($i = 1; $i <= $rowProduct; $i++){
            /* @add attribute */
            $this->attr['category_id_' . $i] = 'Nhóm hàng';
            $this->attr['product_id_' . $i] = 'Sản phẩm';
            $this->attr['count_product_' . $i] = 'Số lượng';

            /* @add rules */
            $rules['category_id_' . $i] = 'required';
            $rules['product_id_' . $i] = 'required';
            $rules['count_product_' . $i] = 'required|numeric';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'max' => ':attribute không được quá 255 ký tự',
            'numeric' => ':attribute phải là 1 số',
            'min' => ':attribute không được bỏ trống'
        ];
    }

    public function attributes()
    {
        $attrDefault =  [
            'code' => 'Mã hóa đơn',
            'customer_id' => 'Khách hàng',
            'staff_id' => 'Nhân viên',
            'note' => 'Ghi chú',
            'total_row' => 'Sản phẩm',
        ];

        return array_merge($attrDefault, $this->attr);
    }
}
