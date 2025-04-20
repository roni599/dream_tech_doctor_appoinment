<?php

namespace App\Http\Controllers\MedicineGroup;

use App\Http\Controllers\Controller;
use App\Models\MedicineGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicineGroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $medicineGroup = MedicineGroup::where('user_id', $user->id)->get();
            return response()->json($medicineGroup, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function store(Request $request)
    {
        $request->validate([
            'medicine_group' => 'required|string|max:255|unique:medicine_groups,group_name'
        ]);
        $user = Auth::user();
        if ($user) {
            MedicineGroup::create([
                'group_name' => $request->medicine_group,
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'Medicine group created successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function medicineEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $medicineGroup = MedicineGroup::find($id);
            if ($medicineGroup) {
                return response()->json($medicineGroup, 200);
            } else {
                return response()->json([
                    'message' => 'No Medicine Group found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json('unauthorized');
    }
    public function medicineEdit(Request $request){
        $user = Auth::user();
        if ($user) {
            $validated =  $request->validate([
                'id' => 'required|exists:medicine_groups,id',
                'medicine_group' => 'required|string|max:255',
                'status' => 'required|boolean',
            ]);

            $medicineGroup = MedicineGroup::find($validated['id']);
            if ($medicineGroup) {
                $medicineGroup->update([
                    'group_name' => $validated['medicine_group'],
                    'status' => $validated['status'],
                    'user_id'=>$user->id
                ]);
                return response()->json(
                    [
                        'message' => 'Medicine Group updated successfully.',
                        'department' => $medicineGroup
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No Medicine Group not found to related this id',
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
               'id' => 'required|exists:medicine_groups,id',
            ]);
            $medicineGroup = MedicineGroup::find($validated['id']);
            if ($medicineGroup) {
                $medicineGroup->delete();
                return response()->json(['message' => 'Medicine Group deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No Medicine Group found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
