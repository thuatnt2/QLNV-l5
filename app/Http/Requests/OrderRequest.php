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
            'purpose' => 'required',
            'file' => 'mimes:doc,docx,xls,xlsx,pdf'
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'purpose.required' => ':attribute phải có ít nhất một lựa chọn',
            'file.mimes' => 'Chỉ upload file doc,docx,xls,xlsx,pdf'
        ];

        return $messages;
    }

    public function attributes()
    {
        $attributes = [
            'purpose' => 'Mục đích yêu cầu',
            'file' => 'File'
        ];

        return $attributes;
    }
}
