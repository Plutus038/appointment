<?php

namespace App\Validators\api;

use App\Validators\Validator;

class DoctorRegisterValidator extends Validator{

    public $rules = array(
        'name' => 'required',
        'email' => 'email|required|unique:doctors',
        'department' => 'required',
        'gender' => 'required|in:F,M',
        'available_start_time' => 'required|date_format:Y-m-d H:i:s',
        'available_end_time' => 'required|date_format:Y-m-d H:i:s',
    );

}