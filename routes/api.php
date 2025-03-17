<?php

use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\MedicineGroup\MedicineGroupController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SymptomController;
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
    Route::get('/hospital-doctor/doctor-viewoffline/{doctor_id}', [DoctorController::class, 'viewDoctorOffline']);

    
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

    Route::get('/roomlist', [RoomController::class, 'index']);
    Route::get('/roomlist/available', [RoomController::class, 'availableRoom']);
    Route::post('/room/store', [RoomController::class, 'store']);
    Route::get('/room/roomlistdata/{id}', [RoomController::class, 'roomlistEditData']);
    Route::post('/room/roomlistedit', [RoomController::class, 'roomlistEdit']);
    Route::post('/room/roomdelete', [RoomController::class, 'delete']);

    Route::get('/reference', [ReferenceController::class, 'index']);
    Route::post('/reference/store', [ReferenceController::class, 'store']);
    Route::get('/reference/referencedata/{id}', [ReferenceController::class, 'referenceEditData']);
    Route::post('/reference/referenceedit', [ReferenceController::class, 'referenceEdit']);
    Route::post('/reference/referencedelete', [ReferenceController::class, 'delete']);

    Route::get('/department',[DepartmentController::class,'index']);
    Route::post('/department/store',[DepartmentController::class,'store']);
    Route::get('/department/department-editdata/{id}', [DepartmentController::class, 'departmentEditData']);
    Route::post('/department/department-edit', [DepartmentController::class, 'departmentEdit']);
    Route::post('/department/departmentdelete', [DepartmentController::class, 'delete']);

    Route::post('/appoinment/store',[AppointmentController::class,'store']);
    Route::get('/appointment/editdata/{appointmentId}', [AppointmentController::class, 'appointmentEditdata']);
    Route::get('/appointment/showdata/{appointmentId}', [AppointmentController::class, 'appointmentShowdata']);
    Route::post('/appoinment/update',[AppointmentController::class,'appoinmentUpdate']);
    Route::get('/appoinment',[AppointmentController::class,'index']);
    Route::post('/appoinment/search',[AppointmentController::class,'searchAppointments']);
    Route::get('/appoinment/report',[AppointmentController::class,'appoinmentReport']);
    Route::post('/appoinment/apoint/search',[AppointmentController::class,'searchAppointmentsApoint']);

    Route::get('/medicine-group',[MedicineGroupController::class, 'index']);
    Route::post('/medicine-group/store',[MedicineGroupController::class,'store']);
    Route::get('/medicine-group/editdata/{id}', [MedicineGroupController::class, 'medicineEditData']);
    Route::post('/medicine-group/edit', [MedicineGroupController::class, 'medicineEdit']);
    Route::post('/medicine-group/delete', [MedicineGroupController::class, 'delete']);
});

Route::get('home/hospital-doctor',[HomeController::class,'doctorshow']);
Route::get('home/hospital',[HomeController::class,'hospitalAll']);
Route::get('home/symptoms', [HomeController::class, 'symptoms']);
Route::get('home/specialist', [HomeController::class, 'specialist']);
Route::get('home/department',[HomeController::class,'department']);
Route::post('/home/search-doctors',[HomeController::class,'searchDoctors']);
Route::post('/home/search-pathology',[HomeController::class,'searchPathology']);
Route::get('/home/hospital-doctor/doctor-view/{doctor_id}', [HomeController::class, 'viewDoctor']);
