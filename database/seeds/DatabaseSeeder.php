<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            'uuid' => Uuid::generate(4)->string,
            'name' => "Doctor1",
            'email' => 'doctor'.time().'@gmail.com',
            'department' => 'department specialist 1',
            'gender' => 'F',
            'available_start_time' => \Carbon\Carbon::now(),
            'available_end_time' => \Carbon\Carbon::now()->addMinutes(60),
        ]);

        $doctor_uuid = '4';

        for($i=0; $i<5 ; $i++){
            DB::table('patient_appointments')->insert([
                'uuid' => Uuid::generate(4)->string,
                'doctor_id' => $doctor_uuid,
                'name' => 'xxx'.$i,
                'reason' => 'Body Pain',
                'age' => '20',
                'gender' => 'M',
                'appointment_time' => \Carbon\Carbon::now()->addMinute(10),
                'status' => 'REQUEST',
            ]);
        }
    }
}
