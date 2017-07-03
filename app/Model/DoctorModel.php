<?php

namespace App\Model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class DoctorModel extends Model
{
    use Uuid;
    protected $table = 'doctors';
}
