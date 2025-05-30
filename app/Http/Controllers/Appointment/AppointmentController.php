<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $currentDate = Carbon::today()->toDateString();

            $appointment = Appointment::where('user_id', $user->id)
                ->whereDate('visit_date', '>=', $currentDate)
                ->with('user', 'doctor', 'departmentCategory')
                ->get();

            return response()->json($appointment, 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function store(AppointmentRequest $request)
    {
        // return response()->json($request->all());
        $user = Auth::user();
        if ($user) {
            $Appointment = Appointment::create([
                "patient_mobile" => $request->input('patient_mobile'),
                "visit_date" => $request->input('visit_date'),
                "patient_name" => $request->input('patient_name'),
                "patient_address" => $request->input('patient_address'),
                "gender" => $request->input('patient_gender'),
                "age" => $request->input('patient_age'),
                "visit_time" => $request->input('visit_time'),
                "payment_status" => $request->input('payment'),
                "description" => $request->input('visit_description'),
                "reference_id" => $request->input('visit_reference_id'),
                "fee" => $request->input('payment') === 'Free' ? 0.00 : $request->input('fee'),
                "amount" => $request->input('amount'),
                "taka" => $request->input('percentage'),
                "discount_free_reference_id" => $request->input('payment') === 'Discount'
                    ? $request->input('discount_reference_id')
                    : $request->input('free_reference_id'),
                "discount_narration" => $request->input('discount_narration'),
                "free_narration" => $request->input('free_narration'),
                "user_id" => $user->id,
                "appointby" => 'Hospital',
                "doctor_id" => $request->input('doctor_id'),
                "department_id" => $request->input('department_category_id'),
                'password' => Hash::make('12345'),
            ]);

            // return response()->json(['message' => 'Department Category stored successfully'], 201);
            return response()->json([
                'message' => 'Department Category stored successfully',
                'appointment' => $Appointment
            ], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function searchAppointments(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $visitDate = $request->input('visit_date');
        $department = $request->input('selectedDepartment');
        $doctor = $request->input('selectedDoctor');
        $query = Appointment::where('user_id', $user->id);

        if ($visitDate && $department === 'all' && $doctor === 'all') {
            $appointment = $query->where('visit_date', $visitDate)
                ->with('doctor', 'user', 'departmentCategory', 'reference')->get();
            return response()->json($appointment);
        }

        if ($visitDate && $department && $doctor === 'all') {
            $appointment = $query->where('visit_date', $visitDate)
                ->where('department_id', $department)
                ->with('doctor', 'user', 'departmentCategory', 'reference')->get();
            return response()->json($appointment);
        }

        if ($visitDate && $doctor && $department === 'all') {
            $appointment = $query->where('visit_date', $visitDate)
                ->where('doctor_id', $doctor)
                ->with('doctor', 'user', 'departmentCategory', 'reference')->get();
            return response()->json($appointment);
        }

        if ($visitDate && $department && $doctor) {
            $appointment = $query->where('visit_date', $visitDate)
                ->where('department_id', $department)
                ->where('doctor_id', $doctor)
                ->with('doctor', 'user', 'departmentCategory', 'reference')->get();
            return response()->json($appointment);
        }
    }
    public function appoinmentReport()
    {
        $user = Auth::user();
        if ($user) {
            $appointment = Appointment::where('user_id', $user->id)
                ->with(['doctor', 'departmentCategory'])
                ->get()
                ->groupBy('doctor_id')
                ->map(function ($doctorAppointments) {
                    $doctor = $doctorAppointments->first()->doctor;
                    $department = $doctorAppointments->first()->departmentCategory;

                    return [
                        'doctor_id' => $doctor->id ?? null,
                        'doctor_name' => $doctor->doctorName ?? 'N/A',
                        'department_id' => $department->id ?? null,
                        'department_name' => $department->department_category ?? 'N/A',
                        'total_appointments' => $doctorAppointments->count(),
                        'total_male' => $doctorAppointments->where('gender', 'Male')->count(),
                        'total_female' => $doctorAppointments->where('gender', 'Female')->count(),
                        'first_time_visits' => $doctorAppointments->where('visit_time', '1st')->count(),
                        'second_time_visits' => $doctorAppointments->where('visit_time', '2nd')->count(),
                        'third_time_visits' => $doctorAppointments->where('visit_time', '3rd')->count(),
                    ];
                })
                ->values();

            return response()->json($appointment);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function searchAppointmentsApoint(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $query = Appointment::where('user_id', $user->id)
                ->with(['doctor', 'departmentCategory']);
            if ($request->has('visit_date') && $request->visit_date) {
                $query->whereDate('visit_date', $request->visit_date);
            }

            if ($request->has('selectedDepartment') && $request->selectedDepartment !== 'all') {
                $query->where('department_id', $request->selectedDepartment);
            }

            if ($request->has('selectedDoctor') && $request->selectedDoctor !== 'all') {
                $query->where('doctor_id', $request->selectedDoctor);
            }

            $appointments = $query->get()
                ->groupBy('doctor_id')
                ->map(function ($doctorAppointments) {
                    $doctor = $doctorAppointments->first()->doctor;
                    $department = $doctorAppointments->first()->departmentCategory;

                    return [
                        'doctor_id' => $doctor->id ?? null,
                        'doctor_name' => $doctor->doctorName ?? 'N/A',
                        'department_id' => $department->id ?? null,
                        'department_name' => $department->department_category ?? 'N/A',
                        'total_appointments' => $doctorAppointments->count(),
                        'total_male' => $doctorAppointments->where('gender', 'Male')->count(),
                        'total_female' => $doctorAppointments->where('gender', 'Female')->count(),
                        'first_time_visits' => $doctorAppointments->where('visit_time', '1st')->count(),
                        'second_time_visits' => $doctorAppointments->where('visit_time', '2nd')->count(),
                        'third_time_visits' => $doctorAppointments->where('visit_time', '3rd')->count(),
                    ];
                })
                ->values();

            return response()->json($appointments);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function appointmentEditdata($appointmentId)
    {
        $user = Auth::user();
        if ($user) {
            $data = Appointment::with('doctor', 'departmentCategory', 'reference', 'discountFreeReference')->findOrFail($appointmentId);
            return response()->json($data);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // public function appoinmentUpdate(Request $request)
    // {
    //     return response()->json($request->all());
    //     $user = Auth::user();
    //     if ($user) {
    //         $appointment = Appointment::findOrFail($request->appoin_id);
    //         $appointment->patient_mobile = $request->input('patient_mobile');
    //         $appointment->Sl_no = $request->input('slNo');
    //         $appointment->visit_date = $request->input('visit_date');
    //         $appointment->patient_name = $request->input('patient_name');
    //         $appointment->patient_address = $request->input('patient_address');
    //         $appointment->gender = $request->input('patient_gender');
    //         $appointment->age = $request->input('patient_age');
    //         $appointment->visit_time = $request->input('visit_time');
    //         $appointment->payment_status = $request->input('payment');
    //         $appointment->description = $request->input('visit_description');
    //         $appointment->reference_id = $request->input('visit_reference_id');
    //         $appointment->fee = $request->input('fee');
    //         $appointment->amount = $request->input('amount');
    //         $appointment->taka = $request->input('percentage');
    //         $appointment->discount_free_reference_id = $request->input('payment') == 'Discount'
    //             ? $request->input('discount_reference_id')
    //             : $request->input('free_reference_id');
    //         $appointment->discount_narration = $request->input('discount_narration');
    //         $appointment->free_narration = $request->input('free_narration');
    //         $appointment->user_id = 1;
    //         $appointment->appointby = 'Hospital';
    //         $appointment->doctor_id = $request->input('doctor_id');
    //         $appointment->department_id = $request->input('department_category_id');
    //         $appointment->save();
    //         return response()->json(['message' => 'Appointment updated successfully'], 200);
    //     }
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }
    public function appoinmentUpdate(AppointmentRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $appointment = Appointment::findOrFail($request->appoin_id);
        $newDoctorId = $request->doctor_id;
        $newVisitDate = $request->visit_date;
        $newDepartmentId = $request->department_category_id;
        if (
            $appointment->doctor_id != $newDoctorId ||
            $appointment->visit_date != $newVisitDate ||
            $appointment->department_id != $newDepartmentId
            ) {
                $maxSlNo = Appointment::where('doctor_id', $newDoctorId)
                ->where('visit_date', $newVisitDate)
                ->where('department_id', $newDepartmentId)
                ->max('Sl_no');

            $appointment->Sl_no = $maxSlNo ? $maxSlNo + 1 : 1;
        } else {
            $existing = Appointment::where('visit_date', $newVisitDate)
                ->where('Sl_no', $request->slNo)
                ->where('id', '!=', $appointment->id)
                ->exists();
                
                if ($existing) {
                    $maxSlNo = Appointment::where('visit_date', $newVisitDate)
                    ->where('doctor_id', $newDoctorId)
                    ->where('department_id', $newDepartmentId)
                    ->max('Sl_no');
                    
                    $appointment->Sl_no = $maxSlNo ? $maxSlNo + 1 : 1;
                } else {
                    $appointment->Sl_no = $request->slNo;
                }
            }
 
        $appointment->patient_mobile = $request->patient_mobile;
        $appointment->visit_date = $newVisitDate;
        $appointment->patient_name = $request->patient_name;
        $appointment->patient_address = $request->patient_address;
        $appointment->gender = $request->patient_gender;

        $appointment->age = $request->patient_age;
        $appointment->visit_time = $request->visit_time;
        $appointment->payment_status = $request->payment;
        $appointment->description = $request->visit_description;
        $appointment->reference_id = $request->visit_reference_id;
        $appointment->fee = $request->fee;
        $appointment->amount = $request->amount;
        $appointment->taka = $request->percentage;

        $appointment->discount_free_reference_id =
            $request->payment === 'Discount'
            ? $request->discount_reference_id
            : $request->free_reference_id;

        $appointment->discount_narration = $request->discount_narration;
        $appointment->free_narration = $request->free_narration;
        $appointment->user_id = $user->id;
        $appointment->appointby = 'Hospital';
        $appointment->doctor_id = $newDoctorId;
        $appointment->department_id = $newDepartmentId;
        $appointment->save();
        return response()->json(['message' => 'Appointment updated successfully'], 200);
    }



    public function appointmentShowdata($appointmentId)
    {
        $user = Auth::user();
        if ($user) {
            $data = Appointment::with('user', 'doctor', 'departmentCategory', 'reference', 'discountFreeReference')->findOrFail($appointmentId);
            return response()->json($data, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function searchAppointmentsPatient($patientId)
    {
        $user = Auth::user();
        if ($user) {
            $data = Appointment::where('patient_mobile', $patientId)->first();
            return response()->json($data);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
