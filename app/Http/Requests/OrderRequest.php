<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderRequest extends Request
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
        $rules = [
            'purposes' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'purposes.required' => ':attribute phải có ít nhất một lựa chọn',
        ];

        return $messages;
    }

    public function attributes()
    {
        $attributes = [
            'purposes' => 'Mục đích yêu cầu',
        ];

        return $attributes;
    }
}
