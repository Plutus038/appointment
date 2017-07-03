<?php

namespace App\Validators;

use App\Exceptions\ValidationFailed;
use Illuminate\Validation\Factory as IlluminateValidator;

abstract class Validator
{
    protected $validator;
    public $custom_errors = array();
    public function __construct(IlluminateValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $data, array $rules = array(), array $custom_errors = array())
    {
        if(empty($rules) && !empty($this->rules) && is_array($this->rules)) {
            $rules = $this->rules;
        }
        if(empty($custom_errors) && !empty($this->custom_errors) && is_array($this->custom_errors)) {
            $custom_errors = $this->custom_errors;
        }
        $validation = $this->validator->make($data, $rules, $custom_errors);
        if($validation->fails()) {
            throw new ValidationFailed($validation->messages());
        }
        return true;
    }
}