<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UnitRequest extends Request
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
            'description' => 'required|max:255',
            'symbol' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => ':attribute bắt buộc và không quá 255 ký tự',
            'symbol.required' => ':attribute bắt buộc và không quá 255 ký tự',
        ];
    }

    public function attributes() 
    {
        return [
            'description' => 'Tên đơn vị',
            'symbol' => 'Ký hiệu'
        ];
    }
}
