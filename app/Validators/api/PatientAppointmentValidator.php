<?php

namespace App\Validators\api;

use App\Validators\Validator;

class PatientAppointmentValidator extends Validator{

    public $rules = array(
        'doctor_uuid' => 'required|uuid',
        'name' => 'required',
        'reason' => 'required',
        'age' => 'required|numeric',
        'gender' => 'required|in:F,M',
        'appointment_time' => 'required|date_format:Y-m-d H:i:s',
        'status' => 'required|in:REQUEST,ACCEPTED,CANCELLED',
    );

}