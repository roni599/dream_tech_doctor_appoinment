<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $experience = Experience::where('user_id',$user->id)->get();
            return response()->json($experience, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function store(Request $request)
    {

        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'experience' => 'required|string|max:255',
            ]);
            Experience::create([
                'experience' => $validated['experience'],
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'experience stored successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function experiencetEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'experience' => 'required|string|max:255',
                'id' => 'required|exists:experiences,id'
            ]);

            $experience = Experience::find($validated['id']);
            if ($experience) {
                $experience->update([
                    'experience' => $validated['experience']
                ]);
                return response()->json(
                    [
                        'message' => 'Experience updated successfully.',
                        'experience' => $experience
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No experience found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function experienceEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $room_number = Experience::findOrfail($id);
            return response()->json($room_number, 200);
        }
        return response()->json('unauthorized');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'id' => 'required|exists:experiences,id'
            ]);
            $experience = Experience::find($validated['id']);
            if ($experience) {
                $experience->delete();
                return response()->json(['message' => 'Experience deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No experience found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
