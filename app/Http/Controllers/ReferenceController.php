<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $references = Reference::where('user_id', $user->id)->get();
            return response()->json($references, 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function referenceEditData($id)
    {
        $user = Auth::user();
        if ($user) {
            $reference = Reference::findOrfail($id);
            return response()->json($reference, 200);
        }
        return response()->json('unauthorized');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:16',
            'address' => 'nullable|string',
        ]);

        $user = Auth::user();

        if ($user) {
            $reference = new Reference();
            $reference->name = $request->name;
            $reference->email = $request->email;
            $reference->phone = $request->phone;
            $reference->address = $request->address;
            $reference->user_id = $user->id;
            $reference->save();
            return response()->json(['message' => 'Reference created successfully', 'data' => $reference], 201);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function referenceEdit(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $validated = $request->validate([
                'id' => 'required|exists:references,id',
                'name' => 'required|string|max:100',
                'email' => 'nullable|email',
                'phone' => 'nullable|string|max:16',
                'address' => 'nullable|string',
                'status'  => 'required|in:0,1'
            ]);

            $reference = Reference::find($validated['id']);
            if ($reference) {
                $reference->update([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'status' => $validated['status']
                ]);
                return response()->json(
                    [
                        'message' => 'Reference updated successfully.',
                        'reference' => $reference
                    ],
                    200
                );
            } else {
                return response()->json([
                    'message' => 'No Reference found to related this id',
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
                'id' => 'required|exists:references,id'
            ]);
            $reference = Reference::find($validated['id']);
            if ($reference) {
                $reference->delete();
                return response()->json(['message' => 'Reference deleted successfully.'], 200);
            } else {
                return response()->json([
                    'message' => 'No Reference found to related this id',
                    'status' => 404,
                ]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
