<?php

namespace App\Transformers;

use App\Model\DoctorModel;
use League\Fractal\TransformerAbstract;

class DoctorTransformer extends TransformerAbstract
{
    public function transform(DoctorModel $doctor) {
        return [
            "id" => $doctor->id,
            "uuid" => $doctor->uuid,
            "name" => $doctor->name,
            "email" => $doctor->email,
            "department" => $doctor->department,
            "gender" => $doctor->gender,
            "available_start_time" => $doctor->available_start_time,
            "available_end_time" => $doctor->available_end_time,
        ];
    }
}