<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KindRequest extends Request
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
            'description' => 'required|min:3|max:255',
            'symbol' => 'required',
        ];
        return $rules;
    }

    public function messages() 
    {
        $messages = [
            'description.required' => ':attribute bắt buộc',
            'description.min' => ':attribute ít nhất 3 ký tự',
            'symbol.required' => ':attribute bắt buộc',
        ];

        return $messages;
    }

    public function attributes()
    {
        $attributes = [
            'description' => 'Tính chất đối tượng',
            'symbol' => 'Ký hiệu',
        ];

        return $attributes;
    }
}
