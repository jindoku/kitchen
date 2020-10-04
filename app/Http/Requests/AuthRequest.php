<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules = [];
        if($this->method() === 'POST'){
            $rules = [
                'username' => 'required|max:100',
                'password' => 'required'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Tài khoản',
            'password' => 'Mật khẩu',
        ];
    }
}
