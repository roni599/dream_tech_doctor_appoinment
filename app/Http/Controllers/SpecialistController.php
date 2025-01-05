<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
{
    public function index()
    {
        $specalist = Specialist::all();
        return response()->json($specalist);
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
}
