<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsRequest extends Request
{
    public $rules = [
        'number_cv_pa71' => 'required|numeric',
        'number_news' => 'required|numeric',
        'page_number' => 'required|numeric'
    ];
    public $messages = [
        'number_news.required' => ':attribute bắt buộc',
        'number_news.numeric' => ':attribute phải là kiểu số nguyên',
        'page_number.required' => ':attribute bắt buộc',
        'page_number.numeric' => ':attribute phải là kiểu số nguyên'
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
        return  [
            'number_news' => 'Số bản tin',
            'page_number' => 'Số trang tin'
        ];
    }
}
