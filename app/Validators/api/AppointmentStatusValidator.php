<?php

namespace App\Validators\api;

use App\Validators\Validator;

class AppointmentStatusValidator extends Validator{

    public $rules = array(
        'appointment_id' => 'required',
        'status' => 'required|in:REQUEST,ACCEPTED,CANCELLED',
    );

}