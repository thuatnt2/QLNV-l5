<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImeiRequest extends Request
{
    public $rules = [
        'phone' => 'required',
        'page_imei' => 'required|numeric',
        'network' => 'required',
        'file' => 'mimes:doc,docx,xls,xlsx,pdf'
    ];
    public $messages = [
        'phone.required' => ':attribute bắt buộc',
        'page_imei.required' => ':attribute bắt buộc',
        'page_imei.numeric' => ':attribute phải là kiểu số nguyên',
        'network.required' => ':attribute bắt buộc',
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
            'page_imei' => 'Số trang imei',
            'network' => 'Nhà mạng',
            'file' => 'File'

        ];
    }
}
