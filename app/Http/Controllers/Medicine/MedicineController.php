<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        return response()->json('okey');
    }
    public function store(Request $request)
    {
        return response()->json($request->all());
    }
}
