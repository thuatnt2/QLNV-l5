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
            'number_cv' => 'required|numeric',
            'number_cv_pa71' => 'required|numeric',
            'order_phone' => 'required',
            'purpose' => 'required',
            'file' => 'mimes:doc,docx,xls,xlsx,pdf'
        ];
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'number_cv.required' => ':attribute bắt buộc',
            'number_cv.numeric' => ':attribute chỉ chứa các ký tự số',
            'number_cv_pa71.required' => 'attribute bắt buộc',
            'order_phone.required' => ':attribute bắt buộc',
            'order_phone.numeric' => ':attribute chỉ chứa các ký tự số',
            'purpose.required' => ':attribute phải có ít nhất một lựa chọn',
            'file.mimes' => 'Chỉ upload file doc,docx,xls,xlsx,pdf'
        ];

        return $messages;
    }

    public function attributes()
    {
        $attributes = [
            'number_cv' => 'Số CV đơn vị y/c',
            'number_cv_pa71' => 'Số CV PA71',
            'order_phone' => 'Số điện thoại',
            'purpose' => 'Mục đích yêu cầu',
            'file' => 'File'
        ];

        return $attributes;
    }
}
