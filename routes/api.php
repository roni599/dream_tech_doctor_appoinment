<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Doctor\DoctorController;
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


    Route::get('/hospital',[DoctorController::class,'hospitalAll']);
    Route::get('/hospital-doctor', [DoctorController::class, 'index']);
    Route::post('/hospital-doctor/store', [DoctorController::class, 'store']);
    Route::post('/hospital-doctor/update', [DoctorController::class, 'update']);
    Route::post('/hospital-doctor/delete-doctor', [DoctorController::class, 'deleteDoctor']);
    Route::post('/hospital-doctor/change-status', [DoctorController::class, 'changeStatus']);
    Route::get('/hospital-doctor/active-doctor', [DoctorController::class, 'activeDoctor']);
    Route::get('/hospital-doctor/dactive-doctor', [DoctorController::class, 'dactiveDoctor']);
    Route::get('/hospital-doctor/doctor-view/{doctor_id}', [DoctorController::class, 'viewDoctor']);

});
