<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return response()->json($department, 200);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'department_category' => 'required|string|max:255',
            ]);
            Department::create([
                'department_category' => $validated['department_category'],
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'Department Category stored successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function departmentEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $department = Department::findOrfail($id);
            return response()->json($department, 200);
        }
        return response()->json('unauthorized');
    }
    public function departmentEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'department_category' => 'required|string|max:255',
                'id' => 'required|exists:departments,id'
            ]);

            $department = Department::findOrFail($validated['id']);
            $department->update([
                'department_category' => $validated['department_category']
            ]);
            return response()->json(
                [
                    'message' => 'Department Category updated successfully.',
                    'department' => $department
                ],
                200
            );
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function delete(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'id' => 'required|exists:departments,id'
            ]);
            $department = Department::findOrFail($validated['id']);
            $department->delete();
            return response()->json(['message' => 'department deleted successfully.'], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
