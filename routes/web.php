<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('/doctor', 'DoctorController@index');
Route::get('/doctor/{doctor_uuid}/appointment', 'DoctorController@appointment');
Route::put('/appointment/{appointment_uuid}/{status}', 'DoctorController@updateAppointment');
