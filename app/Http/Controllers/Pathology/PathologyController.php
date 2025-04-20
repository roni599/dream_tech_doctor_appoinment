<?php

namespace App\Http\Controllers\Pathology;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePathologyRequest;
use App\Models\Pathology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PathologyController extends Controller
{
    public function index()
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }
        $pathology = Pathology::where('user_id', $user->id)
            ->with('user')
            ->get();

        return response()->json($pathology, 200);
    }
    public function store(StorePathologyRequest $request)
    {
        $user = Auth::guard('user_api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized – Admin access only'], 401);
        }

        $pathology = Pathology::create([
            'name' => $request->name,
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
        $pathology = Pathology::with('user')->find($id);
        if ($pathology) {
            return response()->json($pathology, 200);
        } else {
            return response()->json([
                'message' => 'No Medicine  found to related this id',
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
        ]);
    
        $pathology = Pathology::find($validated['id']);
    
        $pathology->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'status' => $request->input('status', $pathology->status), // fallback to existing status
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
