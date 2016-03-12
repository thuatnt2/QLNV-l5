<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ShipRequest extends Request
{
    public $rules = [
        'phone' => 'required',
        'page_list' => 'required|numeric',
        'file' => 'mimes:doc,docx,xls,xlsx,pdf'
    ];

    public $messages = [
        'phone.required' => ':attribute bắt buộc',
        'page_list.required' => ':attribute bắt buộc',
        'page_list.numeric' => ':attribute phải là kiểu số nguyên',
        'file.mimes' => 'Chỉ upload file doc,docx,xls,xlsx,pdf'
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
        return [
            'phone' => 'Số công văn/ thuê bao',
            'page_list' => 'Số trang list',
            'file' => 'File'
        ];
    }
}
