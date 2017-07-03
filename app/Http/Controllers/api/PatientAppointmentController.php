<?php

namespace App\Http\Controllers\api;

use App\Exceptions\ValidationFailed;
use App\Model\DoctorModel;
use App\Model\PatientAppointmentModel;
use App\Transformers\PatientAppointmentTransformer;
use App\Validators\api\AppointmentStatusValidator;
use App\Validators\api\PatientAppointmentValidator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Webpatser\Uuid\Uuid;

class PatientAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, PatientAppointmentValidator $validator)
    {
        try{
            $validator->validate($request->all());
            $doctor = DoctorModel::where([
                'uuid' => $request->input('doctor_uuid')
                ])
                ->firstOrFail();

            $app_time = $request->input('appointment_time');
            $appointment_time = Carbon::parse($app_time)->format('Y-m-d H:i:s');
            $current_time = Carbon::now()->format('Y-m-d H:i:s');
            if($appointment_time > $current_time){
                // Check whether the doctor is available at this time
                $after_onehour = Carbon::parse($app_time)->addMinutes(60)->format('Y-m-d H:i:s');
                $appr_appointment = PatientAppointmentModel::where(
                        ["status" => "ACCEPTED"],
                        ["doctor_id" => $doctor->id]
                    )
                    ->whereBetween('appointment_time', [$doctor->available_start_time, $doctor->available_end_time])
                    ->whereBetween('appointment_time', [$appointment_time, $after_onehour])
                    ->first();

                if(count($appr_appointment) > 0){
                    $appointment["data"]["message"] = "Doctor is not available at that time";
                    return Response::json($appointment["data"], 422, [], JSON_UNESCAPED_UNICODE);
                }
                else{
                    $appointment = new PatientAppointmentModel();
                    $appointment->uuid = Uuid::generate(4)->string;
                    $appointment->doctor_id = $doctor->id;
                    $appointment->name = $request->input('name');
                    $appointment->reason = $request->input('reason');
                    $appointment->age = $request->input('age');
                    $appointment->gender = $request->input('gender');
                    $appointment->appointment_time = $request->input('appointment_time');
                    $appointment->status = $request->input('status');
                    $appointment->save();

                    $appointment = \Fractal::Item($appointment)
                        ->transformWith(new PatientAppointmentTransformer())
                        ->toArray();
                    $appointment["data"]["message"] = "Appointment created successfully";
                    return Response::json($appointment["data"], 201, [], JSON_UNESCAPED_UNICODE);
                }
            }
            else{
                $appointment["data"]["message"] = "Appointment time, should be a future time";
                return Response::json($appointment["data"], 422, [], JSON_UNESCAPED_UNICODE);
            }

        }
        catch (ValidationFailed $v) {
            $status = 422;
            $response = array(
                "success" => false,
                "error" => 'Invalid Input',
                "error_code" => $status,
                "error_messages" => $v->getErrors()
            );
            return Response::json($response, $status, [], JSON_UNESCAPED_UNICODE);
        }
        catch (ModelNotFoundException $e) {
            $data = "Record not found with our database";
            return Response::json($data, 404, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $response = array(
                "success" => false,
                "error" => "Something went wrong",
                "error_code" => 500,
            );
            return Response::json($response, 500, [], JSON_UNESCAPED_UNICODE);
        }
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
     * @param Request $request
     * @param $doctor_uuid
     * @return mixed
     */
    public function update(Request $request, $doctor_uuid, AppointmentStatusValidator $validator)
    {
        try{
            $validator->validate($request->all());

            // Update the request status to be accepted
            $update = PatientAppointmentModel::leftJoin('doctors AS doc', 'patient_appointments.doctor_id', 'doc.id')
                ->where([
                    'patient_appointments.uuid' => $request->input('appointment_id'),
                    'doc.uuid' => $doctor_uuid,
                ])
                ->select('patient_appointments.*')
                ->first();

            if($update){
                $update->status = 'ACCEPTED';
                $update->save();
            }

            // Cancel the remaining the appointment
            $appointment = PatientAppointmentModel::where([
                'uuid' => $request->input('appointment_id'),
            ])->first();
            $after_onehour = Carbon::parse($appointment->appointment_time)->addMinutes(60)->format('Y-m-d H:i:s');
            PatientAppointmentModel::where(
                    ["status" => "REQUEST"],
                    ["doctor_id" => $appointment->doctor_id]
                )
                ->whereBetween('appointment_time', [$appointment->appointment_time, $after_onehour])
                ->update([
                    'status' => 'CANCELLED'
                ]);
            $res = [
                'success' => true,
                'message' => "Appointment status update successfully",
            ];
            return Response::json($res, 201, [], JSON_UNESCAPED_UNICODE);
        }
        catch (ValidationFailed $v) {
            $status = 422;
            $response = array(
                "success" => false,
                "error" => 'Invalid Input',
                "error_code" => $status,
                "error_messages" => $v->getErrors()
            );
            return Response::json($response, $status, [], JSON_UNESCAPED_UNICODE);
        }
        catch (ModelNotFoundException $e) {
            $data = "Record not found with our database";
            return Response::json($data, 404, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $response = array(
                "success" => false,
                "error" => "Something went wrong",
                "error_code" => 500,
            );
            return Response::json($response, 500, [], JSON_UNESCAPED_UNICODE);
        }
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


    public function getDoctors(){
        try{
            $doctors = DoctorModel::select(['uuid', 'name'])->get();
            return Response::json($doctors, 200, [], JSON_UNESCAPED_UNICODE);
        }
        catch (ValidationFailed $v) {
            $status = 422;
            $response = array(
                "success" => false,
                "error" => 'Invalid Input',
                "error_code" => $status,
                "error_messages" => $v->getErrors()
            );
            return Response::json($response, $status, [], JSON_UNESCAPED_UNICODE);
        }
        catch (ModelNotFoundException $e) {
            $data = "Record not found with our database";
            return Response::json($data, 404, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $response = array(
                "success" => false,
                "error" => "Something went wrong",
                "error_code" => 500,
            );
            return Response::json($response, 500, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
