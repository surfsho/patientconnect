<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\NewPatientController;
use App\Http\Controllers\ChooseDateController;
use App\Http\Controllers\ChooseProviderController;
use App\Http\Controllers\BookAppointmentController;
use App\Http\Controllers\AppointmentDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class,"index"]);
Route::get('/newpatient', [NewPatientController::class,"index"]);
Route::get('/choosedate', [ChooseDateController::class,"index"]);
Route::get('/chooseprovider',[ChooseProviderController::class,"index"]);
Route::post('/createprovider',[ChooseProviderController::class,"create"]);
//Route::get('/bookappointment',[BookAppointmentController::class,"index"]);
Route::post('/newpatient', [NewPatientController::class,"create"]);
Route::post('/bookappointment',[BookAppointmentController::class,"create"]);
Route::get('/appointmentdashboard',[AppointmentDashboardController::class,"index"]);
Route::post('/sendemail',[AppointmentDashboardController::class,"sendEmail"]);
Route::get('/createtemplate',[AppointmentDashboardController::class,"createTemplate"]);
Route::post('/newtemplate',[AppointmentDashboardController::class,"newTemplate"]);