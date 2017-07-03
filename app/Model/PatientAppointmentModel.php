<?php

namespace App\Model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class PatientAppointmentModel extends Model
{
    use Uuid;

    protected $table = 'patient_appointments';
}
