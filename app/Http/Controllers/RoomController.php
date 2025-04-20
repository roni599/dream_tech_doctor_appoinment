<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $roomlist = Room::where('user_id', $user->id)->get();
            return response()->json($roomlist, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'room_number' => 'required|string|max:5',
            ]);
            Room::create([
                'room_number' => $validated['room_number'],
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'Room Number stored successfully'], 201);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function roomlistEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'room_number' => 'required|string|max:5',
                'room_status' => 'required',
                'id' => 'required|exists:rooms,id'
            ]);

            $room = Room::find($validated['id']);
            if ($room) {
                $room->update([
                    'room_number' => $validated['room_number'],
                    'status' => $validated['room_status']
                ]);
                return response()->json(
                    [
                        'message' => 'Room Number updated successfully.',
                        'romm_number' => $room
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No Room number found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function roomlistEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $roomlist = Room::findOrfail($id);
            return response()->json($roomlist, 200);
        }
        return response()->json('unauthorized');
    }
    public function delete(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'id' => 'required|exists:rooms,id'
            ]);
            $room = Room::find($validated['id']);
            if ($room) {
                $room->delete();
                return response()->json(['message' => 'Room Number deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No Room Number found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function availableRoom()
    {
        $user = Auth::user();
        if ($user) {
            $roomlist = Room::where('status', 1)->get();
            return response()->json($roomlist, 200);
        }
        return response()->json('unauthorized');
    }
}
