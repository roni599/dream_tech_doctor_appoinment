<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){
        $doctor=Doctor::all();
        return response()->json($doctor);
    }
    public function store(Request $request){
        return response()->json('oeky');
    }
}
