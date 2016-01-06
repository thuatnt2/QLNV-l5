<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
{
    public $rules = [
        
            'description' => 'required|min:3|max:255',
            'symbol' => 'required',
        ];

    public $messages = [

        'description.required' => ':attribute bắt buộc',
        'symbol.required' => ':attribute bắt buộc',
    ];

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
        return $this->rules;
    }

    public function messages() 
    {
        return $this->messages;
    }

    public function attributes()
    {
        return [
            'description' => 'Loại đối tượng',
            'symbol' => 'Ký hiệu',
        ];
    }
}
