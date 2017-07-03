<?php

namespace App\Transformers;

use App\Model\PatientAppointmentModel;
use League\Fractal\TransformerAbstract;

class PatientAppointmentTransformer extends TransformerAbstract
{
    public function transform(PatientAppointmentModel $appointment) {
        return [
            "id" => $appointment->id,
            "uuid" => $appointment->uuid,
            "name" => $appointment->name,
            "reason" => $appointment->reason,
            "age" => $appointment->age,
            "gender" => $appointment->gender,
            "appointment_time" => $appointment->appointment_time,
            "status" => $appointment->status,
        ];
    }
}