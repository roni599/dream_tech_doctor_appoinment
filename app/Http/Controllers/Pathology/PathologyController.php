<?php

namespace App\Http\Controllers\Pathology;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePathologyRequest;
use App\Models\Pathology;
use App\Models\PathologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PathologyController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user_api')->user();
        $doctor = Auth::guard('doctor_api')->user();

        if (!$user && !$doctor) {
            return response()->json(['error' => 'Unauthorized – Admin or Doctor access only'], 401);
        }

        if ($doctor) {
            $pathology = PathologyCategory::where('user_id', $doctor->user_id)
                ->whereHas('pathologies')
                ->with('user', 'pathologies')
                ->get();

            return response()->json($pathology, 200);
        }

        if ($user) {
            $pathology = PathologyCategory::where('user_id', $user->id)
                ->whereHas('pathologies') 
                ->with('user', 'pathologies')
                ->get();

            return response()->json($pathology, 200);
        }
    }

    public function store(StorePathologyRequest $request)
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }

        $pathology = Pathology::create([
            'name' => $request->name,
            'pathology_category_id' => $request->pathology_category,
            'price' => $request->price,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Pathology created successfully',
            'pathology' => $pathology
        ], 201);
    }

    public function pathologyEditData($id)
    {
        $user = Auth::guard('user_api')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }
        $pathology = Pathology::with('user', 'category')->find($id);
        if ($pathology) {
            return response()->json($pathology, 200);
        } else {
            return response()->json([
                'message' => 'No Pathology  found to related this id',
                'status' => 404,
            ]);
        }
        return response()->json('unauthorized');
    }


    public function pathologyEdit(Request $request)
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        $validated = $request->validate([
            'id' => 'required|integer|exists:pathologies,id',
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('pathologies', 'name')->ignore($request->id),
            ],
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|in:0,1',
            'pathology_category_id' => 'required|exists:pathology_categories,id',
        ]);

        $pathology = Pathology::find($validated['id']);

        $pathology->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'pathology_category_id' => $validated['pathology_category_id'],
            'status' => $request->input('status', $pathology->status),
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Pathology updated successfully.',
            'pathology' => $pathology
        ], 200);
    }

    public function delete(Request $request)
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }
        $pathology = Pathology::find($request->id);
        $pathology->delete();

        return response()->json('Pathology deleted successfully', 201);
    }
}
