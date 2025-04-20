<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SymptomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $symtom = Symptom::with('user')->where('user_id', $user->id)->get();
            return response()->json($symtom, 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'symptom' => 'required|string|max:255',
            ]);
            Symptom::create([
                'symptom' => $validated['symptom'],
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'Symptom stored successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function symtomEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $symtom = Symptom::find($id);
            if ($symtom) {
                return response()->json($symtom, 200);
            } else {
                return response()->json([
                    'message' => 'No Sytom found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json('unauthorized');
    }
    public function symtomEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'symptom' => 'required|string|max:255',
                'id' => 'required|exists:symptoms,id'
            ]);

            $symptom = Symptom::find($validated['id']);
            if ($symptom) {
                $symptom->update([
                    'symptom' => $validated['symptom']
                ]);
                return response()->json(
                    [
                        'message' => 'Symptom updated successfully.',
                        'symtom' => $symptom
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No Sytom found to related this id',
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
                'id' => 'required|exists:symptoms,id'
            ]);
            $symptom = Symptom::find($validated['id']);
            if ($symptom) {
                $symptom->delete();
                return response()->json(['message' => 'Symptom deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No Sytom found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
