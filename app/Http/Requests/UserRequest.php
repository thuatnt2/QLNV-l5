<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'username' => 'required',
            'fullname' => 'required',
        ];
    }

    public function messages() {

        return [
            'username.required' => ':attribute bắt buộc có',
            'fullname.required' => ':attribute bắt buộc có'
        ];
    }

    public function attributes() {

        return [
            'username' => 'Tên đăng nhập',
            'fullname' => 'Họ và tên'
        ];
    }
}

