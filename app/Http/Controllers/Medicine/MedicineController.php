<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineRequest;
use App\Models\Medicine;
use App\Models\MedicineGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user_api')->user();
        if ($user) {
            $medicine = Medicine::with('medicineGroup')->where('user_id',$user->id)->get();
            return response()->json($medicine, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function doctorUserMedicine()
    {
        $user = Auth::guard('user_api')->user();
        $doctor = Auth::guard('doctor_api')->user();

        if (!$user && !$doctor) {
            return response()->json(['error' => 'Unauthorized – Admin or Doctor access only'], 401);
        }

        if ($doctor) {
            $medicine = MedicineGroup::where('user_id', $doctor->user_id)
                ->whereHas('medicines')
                ->with('user', 'medicines')
                ->get();

            return response()->json($medicine, 200);
        }

        if ($user) {
            $medicine = MedicineGroup::where('user_id', $user->id)
                ->whereHas('medicines')
                ->with('user', 'medicines')
                ->get();
            return response()->json($medicine, 200);
        }
    }
    public function store(MedicineRequest $request)
    {
        $user = Auth::user();
        if ($user) {
            $data = Medicine::create([
                'medicine_name' => $request->input('medicine_name'),
                'strength' => $request->input('medicine_strength'),
                'dosages_description' => $request->input('dosages_description'),
                'medicine_group_id' => $request->input('medicine_group_id'),
                'user_id' => $user->id,
            ]);

            return response()->json(['message' => 'Medicine created successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function medicineEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $medicine = Medicine::with('medicineGroup')->find($id);
            if ($medicine) {
                return response()->json($medicine, 200);
            } else {
                return response()->json([
                    'message' => 'No Medicine  found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json('unauthorized');
    }

    public function medicineEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'id' => 'required|integer|exists:medicines,id',
            ]);

            $medicine = Medicine::find($validated['id']);
            if ($medicine) {
                $medicine->update([
                    'medicine_name' => $request->input('medicine_name'),
                    'strength' => $request->input('medicine_strength'),
                    'dosages_description' => $request->input('dosages_description'),
                    'medicine_group_id' => $request->input('medicine_group_id'),
                    'status' => $request->input('status'),
                    'user_id' => $user->id,
                ]);
                return response()->json(
                    [
                        'message' => 'Medicine updated successfully.',
                        'medicine' => $medicine
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No Medicine not found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'id' => 'required|integer|exists:medicines,id',
            ]);
            $medicine = Medicine::find($validated['id']);
            if ($medicine) {
                $medicine->delete();
                return response()->json(['message' => 'Medicine deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No Medicine found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
