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

class AppointmentController extends Controller
{

    // public function index()
    // {
    //     $user = Auth::user();
    //     if ($user) {
    //         $formattedDate = \Carbon\Carbon::now()->format('m/d/Y');
    //         $appointment = Appointment::whereRaw("STR_TO_DATE(visit_date, '%m/%d/%Y') = STR_TO_DATE(?, '%m/%d/%Y')", [$formattedDate])
    //             ->with('user', 'departmentCategory', 'reference', 'doctor', 'discountFreeReference')
    //             ->get();

    //         return response()->json($appointment, 200);
    //     }
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $currentDate = Carbon::today()->toDateString(); // Get today's date in 'YYYY-MM-DD' format

            $appointment = Appointment::whereDate('visit_date', $currentDate)->with('user', 'doctor', 'departmentCategory')->get();
            return response()->json($appointment, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function store(AppointmentRequest $request)
    {
        $user = Auth::user();
        if ($user) {
            $Appointment = Appointment::create([
                "patient_mobile" => $request->input('patient_mobile'),
                "Sl_no" => $request->input('slNo'),
                "visit_date" => $request->input('visit_date'),
                "patient_name" => $request->input('patient_name'),
                "patient_address" => $request->input('patient_address'),
                "gender" => $request->input('patient_gender'),
                "age" => $request->input('patient_age'),
                "visit_time" => $request->input('visit_time'),
                "payment_status" => $request->input('payment'),
                "description" => $request->input('visit_description'),
                "reference_id" => $request->input('visit_reference_id'),
                "fee" => $request->input('fee'),
                "amount" => $request->input('amount'),
                "taka" => $request->input('percentage'),
                "discount_free_reference_id" => $request->input('payment') == 'Discount'
                    ? $request->input('discount_reference_id')
                    : $request->input('free_reference_id'),
                "discount_narration" => $request->input('discount_narration'),
                "free_narration" => $request->input('free_narration'),
                "user_id" => 1,
                "doctor_id" => $request->input('doctor_id'),
                "department_id" => $request->input('department_category_id'),
            ]);
            return response()->json(['message' => 'Department Category stored successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function searchAppointments(Request $request)
    {
        $visitDate = $request->input('visit_date');
        $department = $request->input('selectedDepartment');
        $doctor = $request->input('selectedDoctor');
        $query = Appointment::query();
        if ($visitDate && $department === 'all' && $doctor === 'all') {
            $appointment = $query->where('visit_date', $visitDate)->with('doctor', 'user', 'departmentCategory','reference')->get();
            return response()->json($appointment);
        }

        if ($visitDate && $department && $doctor === 'all') {
            $appointment = $query->where('visit_date', $visitDate)
                ->where('department_id', $department)->with('doctor', 'user', 'departmentCategory','reference')->get();
            return response()->json($appointment);
        }
        if ($visitDate && $doctor && $department === 'all') {
            $appointment = $query->where('visit_date', $visitDate)
                ->where('doctor_id', $doctor)->with('doctor', 'user', 'departmentCategory','reference')->get();
            return response()->json($appointment);
        }
        if ($visitDate && $department && $doctor) {
            $appointment = $query->where('visit_date', $visitDate)
                ->where('department_id', $department)
                ->where('doctor_id', $doctor)->with('doctor', 'user', 'departmentCategory','reference')->get();
            return response()->json($appointment);
        }
    }
    public function appoinmentReport()
    {
        $appointment = Appointment::with(['doctor', 'departmentCategory'])
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
}
