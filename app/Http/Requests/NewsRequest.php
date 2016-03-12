<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsRequest extends Request
{
    public $rules = [
        'phone' => 'required',
        'number_cv_pa71' => 'required|numeric',
        'page_news' => 'required|numeric',
        'file' => 'mimes:doc,docx,xls,xlsx,pdf'
    ];
    public $messages = [
        'phone.required' => ':attribute bắt buộc',
        'number_cv_pa71.required' => ':attribute bắt buộc',
        'number_cv_pa71.numeric' => ':attribute phải là kiểu số nguyên',
        'page_number.required' => ':attribute bắt buộc',
        'page_number.numeric' => ':attribute phải là kiểu số nguyên',
        'file.mimes' => 'Chỉ upload file doc,docx,xls,xlsx,pdf'
        // 'file.required' => ':attribute bắt buộc'
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
            'phone' => 'Số công văn- thuê bao',
            'number_cv_pa71' => 'Số công văn',
            'page_number' => 'Số trang tin',
            'file' => 'File'

        ];
    }
}
