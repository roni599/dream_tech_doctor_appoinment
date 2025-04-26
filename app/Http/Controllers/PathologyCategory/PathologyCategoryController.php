<?php

namespace App\Http\Controllers\PathologyCategory;

use App\Http\Controllers\Controller;
use App\Models\PathologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PathologyCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }
        $pathology_category = PathologyCategory::where('user_id', $user->id)
            ->with('user')
            ->get();

        return response()->json($pathology_category, 200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:pathology_categories,name',
        ]);

        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }

        $pathology_category = PathologyCategory::create([
            'name' => $validated['name'],
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Pathology category created successfully',
            'pathology' => $pathology_category
        ], 201);
    }

    public function delete(Request $request)
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }
        $pathology = PathologyCategory::find($request->id);
        $pathology->delete();

        return response()->json('Pathology Category deleted successfully', 201);
    }

    public function pathologyCategoryEditData($id)
    {
        $user = Auth::guard('user_api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }
        $pathology_category = PathologyCategory::with('user')->find($id);
        if ($pathology_category) {
            return response()->json($pathology_category, 200);
        } else {
            return response()->json([
                'message' => 'No Pathology Category found to related this id',
                'status' => 404,
            ]);
        }
        return response()->json('unauthorized');
    }


    public function pathologyCategoryEdit(Request $request)
    {
        
        $user = Auth::guard('user_api')->user();
    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $validated = $request->validate([
            'id' => 'required|integer|exists:pathology_categories,id',
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('pathology_categories', 'name')->ignore($request->id),
            ],
            'status' => 'nullable|in:0,1',
        ]);
    
        $pathology_category = PathologyCategory::find($validated['id']);
        $pathology_category->update([
            'name' => $validated['name'],
            'status' => $validated['status'],
            'user_id' => $user->id,
        ]);
    
        return response()->json([
            'message' => 'Pathology Category updated successfully.',
            'pathology' => $pathology_category
        ], 200);
    }
}
