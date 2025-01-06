<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SymptomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('send_otp', [AuthController::class, 'sendOTP']);
    Route::post('password_reset_otp_check', [AuthController::class, 'passwordResetOtpCheck']);
    Route::post('reset_password', [AuthController::class, 'resetPassword']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);


    Route::get('/hospital', [DoctorController::class, 'hospitalAll']);
    Route::get('/hospital-doctor', [DoctorController::class, 'index']);
    Route::post('/hospital-doctor/store', [DoctorController::class, 'store']);
    Route::post('/hospital-doctor/update', [DoctorController::class, 'update']);
    Route::post('/hospital-doctor/delete-doctor', [DoctorController::class, 'deleteDoctor']);
    Route::post('/hospital-doctor/change-status', [DoctorController::class, 'changeStatus']);
    Route::get('/hospital-doctor/active-doctor', [DoctorController::class, 'activeDoctor']);
    Route::get('/hospital-doctor/dactive-doctor', [DoctorController::class, 'dactiveDoctor']);
    Route::get('/hospital-doctor/doctor-view/{doctor_id}', [DoctorController::class, 'viewDoctor']);

    Route::get('/symptoms', [SymptomController::class, 'index']);
    Route::post('/symptoms/store', [SymptomController::class, 'store']);
    Route::get('/symtom/symtomeditdata/{id}', [SymptomController::class, 'symtomEditData']);
    Route::post('/symtom/symtomedit', [SymptomController::class, 'symtomEdit']);
    Route::post('/symtom/symtomdelete', [SymptomController::class, 'delete']);

    Route::get('/specialist', [SpecialistController::class, 'index']);
    Route::post('/specialist/store', [SpecialistController::class, 'store']);
    Route::get('/specialist/specialistditdata/{id}', [SpecialistController::class, 'specialistEditData']);
    Route::post('/specialist/specialistedit', [SpecialistController::class, 'specialistEdit']);
    Route::post('/specialist/specialistdelete', [SpecialistController::class, 'delete']);

    Route::get('/experience', [ExperienceController::class, 'index']);
    Route::post('/experience/store', [ExperienceController::class, 'store']);
    Route::get('/experience/experiencedata/{id}', [ExperienceController::class, 'experienceEditData']);
    Route::post('/experience/experienceedit', [ExperienceController::class, 'experiencetEdit']);
    Route::post('/experience/experiencedelete', [ExperienceController::class, 'delete']);
});

Route::get('home/hospital-doctor',[HomeController::class,'doctorshow']);
Route::get('home/hospital',[HomeController::class,'hospitalAll']);
Route::get('home/symptoms', [HomeController::class, 'symptoms']);
Route::get('home/specialist', [HomeController::class, 'specialist']);

Route::post('/home/doctorsearch',[HomeController::class,'doctorSearch']);
