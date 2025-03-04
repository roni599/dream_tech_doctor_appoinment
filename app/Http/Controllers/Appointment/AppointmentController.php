<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user) {
            $appointment = Appointment::where('user_id',$user->id)->with('user','departmentCategory','reference','doctor','discountFreeReference')->get();
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
}
