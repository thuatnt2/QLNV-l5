<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    // protected $validation;
    // private $validator;
    // public $formData;

    // public function __construct(ValidatorFactory $validator)
    // {
    // 	$this->validator = $validator;
    // }

    // public function validate()
    // {
    //     $this->validation = parent::validate();
    // 	if($this->validation->fails()) {

    // 		throw new FormValidationException('Validation Failed', $this->getValidationErrors());
    // 	}
    // }

    //  protected function getValidationErrors()
    // {
    //     return $this->validation->errors();
    // }

}
