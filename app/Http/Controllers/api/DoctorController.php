<?php

namespace App\Http\Controllers\api;

use App\Exceptions\ValidationFailed;
use App\Model\DoctorModel;
use App\Transformers\DoctorTransformer;
use App\Validators\api\DoctorRegisterValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Webpatser\Uuid\Uuid;

class DoctorController extends Controller
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
    public function store(Request $request, DoctorRegisterValidator $validator)
    {
        try{
            $validator->validate($request->all());
            $doctor = new DoctorModel();
            $doctor->uuid = Uuid::generate(4)->string;
            $doctor->name = $request->input('name');
            $doctor->email = $request->input('email');
            $doctor->department = $request->input('department');
            $doctor->gender = $request->input('gender');
            $doctor->available_start_time = $request->input('available_start_time');
            $doctor->available_end_time = $request->input('available_end_time');
            $doctor->save();

            $doctor = \Fractal::Item($doctor)
                ->transformWith(new DoctorTransformer())
                ->toArray();
            $doctor["data"]["message"] = "Doctor information added successfully";
            return Response::json($doctor["data"], 201, [], JSON_UNESCAPED_UNICODE);
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
}
