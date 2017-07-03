<?php

namespace App\Http\Controllers;

use App\Model\DoctorModel;
use App\Model\PatientAppointmentModel;
use Camroncade\Timezone\Facades\Timezone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctor = DoctorModel::all();

        return view('backend.doctor.list')
            ->with([
                'doctor' => $doctor,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function appointment($doctor_uuid, Request $request){
        $appointments = PatientAppointmentModel::leftjoin('doctors as doc', 'patient_appointments.doctor_id', 'doc.id')
            ->where([
                'doc.uuid' =>  $doctor_uuid
            ])
            ->select(['patient_appointments.*', 'doc.name AS doc_name'])
            ->get();
        $selected = $request->input('timezone');
        $placeholder = 'Select a timezone';
        $formAttributes = array('class' => 'swegForm', 'style' => 'float:right;', 'name' => 'timezone', 'onclick' => 'submit()');
        $optionAttributes = array('customValue' => 'true');

        $timezone = Timezone::selectForm($selected, $placeholder, $formAttributes, $optionAttributes);


        return view('backend.appointment.list')
            ->with([
                'appointments' => $appointments,
                'timezone' => $timezone,
                'selected' => $selected,
            ]);
    }

    public function updateAppointment($appointment_id, $status){
        $appointment = PatientAppointmentModel::where([
            'uuid' => $appointment_id
        ])->first();

        $appointment->status = 'ACCEPTED';
        $appointment->save();

        $after_onehour = Carbon::parse($appointment->appointment_time)->addMinutes(60)->format('Y-m-d H:i:s');
        PatientAppointmentModel::where(
                ["status" => "REQUEST"],
                ["doctor_id" => $appointment->doctor_id]
            )
            ->whereBetween('appointment_time', [$appointment->appointment_time, $after_onehour])
            ->update([
                'status' => 'CANCELLED'
            ]);

        echo "succ"; exit();
    }

}
