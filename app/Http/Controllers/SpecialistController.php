<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $specalist = Specialist::where('user_id', $user->id)->get();
            return response()->json($specalist, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'specialist' => 'required|string|max:255',
            ]);
            Specialist::create([
                'specialist' => $validated['specialist'],
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'specialist stored successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function specialistEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $specialist = Specialist::find($id);
            if ($specialist) {
                return response()->json($specialist, 200);
            } else {
                return response()->json([
                    'message' => 'No specialist found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json('unauthorized');
    }
    public function specialistEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'specialist' => 'required|string|max:255',
                'id' => 'required|exists:specialists,id'
            ]);

            $specialist = Specialist::find($validated['id']);
            if ($specialist) {
                $specialist->update([
                    'specialist' => $validated['specialist']
                ]);
                return response()->json(
                    [
                        'message' => 'Specialist updated successfully.',
                        'specialist' => $specialist
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No specialist found to related this id',
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
                'id' => 'required|exists:specialists,id'
            ]);
            $specialist = Specialist::find($validated['id']);
            if ($specialist) {
                $specialist->delete();
                return response()->json(['message' => 'Specialist deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No specialist found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
