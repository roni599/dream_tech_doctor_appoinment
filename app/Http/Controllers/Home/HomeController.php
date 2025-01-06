<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function doctorshow()
    {
        $doctor = Doctor::with(['users:id'])->get();
        return response()->json($doctor, 200);
    }
    public function hospitalAll()
    {

        $hospitalNames = User::pluck('hospital_name');
        $doctorDepartment = Doctor::distinct()->pluck('deparment_category')->toArray();
        return response()->json([
            'hospitalNames' => $hospitalNames,
            'doctorDepartments' => $doctorDepartment,
        ], 200);
    }
    public function symptoms()
    {
        $symtom = Symptom::all();
        return response()->json($symtom, 200);
    }

    public function specialist()
    {
        $specalist = Specialist::all();
        return response()->json($specalist, 200);
    }
    public function doctorSearch(Request $request)
    {
        return response()->json($request->all());
    }
}
