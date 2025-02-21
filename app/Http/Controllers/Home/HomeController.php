<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function doctorshow()
    {
        $doctor = Doctor::with('user')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MIN(id)')
                    ->from('doctors')
                    ->groupBy('regnum');
            })
            ->get();

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

    public function department()
    {
        $department = Department::all();
        return response()->json($department, 200);
    }

    public function searchDoctors(Request $request)
    {
        $query = Doctor::query();
        $query->join('users', 'doctors.user_id', '=', 'users.id');
        if ($request->has('department_name') && $request->input('department_name') != '') {
            $query->where('deparment_category', $request->input('department_name'));
        }
        if ($request->has('gender') && $request->input('gender') != '') {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->has('experience') && $request->input('experience') != '') {
            $query->where('experience', $request->input('experience'));
        }
        if ($request->has('Specialist') && $request->input('Specialist')) {
            $specialists = $request->input('Specialist');
            $query->where(function ($q) use ($specialists) {
                $matchCount = 0;
                foreach ($specialists as $specialist) {
                    $q->orWhereJsonContains('Specialist', $specialist);
                    $matchCount++;
                    if ($matchCount >= 3) {
                        break;
                    }
                }
            });
        }
        if ($request->has('symptoms') && $request->input('symptoms')) {
            $symptoms = $request->input('symptoms');
            $matchCount = 0;

            $query->where(function ($q) use ($symptoms, &$matchCount) {
                foreach ($symptoms as $symptom) {
                    $q->orWhereJsonContains('symptom', $symptom);
                    $matchCount++;
                }
            });

            if ($matchCount < 2) {
                $query->whereRaw('1 = 0');
            }
        }
        if ($request->has('district') && $request->input('district') != '') {
            $query->where('users.district', $request->input('district'));
        }

        if ($request->has('sub_district') && $request->input('sub_district') != '') {
            $query->where('users.sub_district', $request->input('sub_district'));
        }

        if ($request->has('division') && $request->input('division') != '') {
            $query->where('users.division', $request->input('division'));
        }

        if ($request->has('hospital_name') && $request->input('hospital_name') != '') {
            $query->where('users.hospital_name', $request->input('hospital_name'));
        }

        $doctors = $query->get();
        return response()->json([
            'success' => true,
            'doctors' => $doctors,
        ], 200);
    }

    public function searchPathology(Request $request)
    {
        return response()->json($request->all());
        $query = Doctor::query();
        $query->join('users', 'doctors.user_id', '=', 'users.id');
        if ($request->has('department_name') && $request->input('department_name') != '') {
            $query->where('deparment_category', $request->input('department_name'));
        }

        if ($request->has('symptoms') && $request->input('symptoms')) {
            $symptoms = $request->input('symptoms');
            $matchCount = 0;

            $query->where(function ($q) use ($symptoms, &$matchCount) {
                foreach ($symptoms as $symptom) {
                    $q->orWhereJsonContains('symptom', $symptom);
                    $matchCount++;
                }
            });

            if ($matchCount < 2) {
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->has('district') && $request->input('district') != '') {
            $query->where('users.district', $request->input('district'));
        }

        if ($request->has('sub_district') && $request->input('sub_district') != '') {
            $query->where('users.sub_district', $request->input('sub_district'));
        }

        if ($request->has('division') && $request->input('division') != '') {
            $query->where('users.division', $request->input('division'));
        }

        if ($request->has('hospital_name') && $request->input('hospital_name') != '') {
            $query->where('users.hospital_name', $request->input('hospital_name'));
        }

        $doctors = $query->get();
        return response()->json([
            'success' => true,
            'doctors' => $doctors,
        ], 200);
    }
    public function viewDoctor($doctor_id)
    {
        $doctor = Doctor::with('user')->find($doctor_id);

        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $regnum = Doctor::with('user')->where('regnum', $doctor->regnum)->get();
        return response()->json([
            'message' => 'Doctor Data retrieved successfully',
            'doctor' => $doctor,
            'regnum' => $regnum
        ], 200);
    }
}
