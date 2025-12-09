<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficialController extends Controller
{
    public function index(Request $request)
    {
        $query = Official::query();

        if (!$request->user() || !$request->user()->isAdmin()) {
            $query->where('is_active', true);
        }

        $officials = $query->orderBy('order')->get();
        return response()->json($officials);
    }

    public function store(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'position', 'contact', 'email', 'order', 'is_active']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('officials', 'public');
        }

        $official = Official::create($data);

        return response()->json([
            'message' => 'Official added successfully',
            'official' => $official,
        ], 201);
    }

    public function show(Official $official)
    {
        return response()->json($official);
    }

    public function update(Request $request, Official $official)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'position', 'contact', 'email', 'order', 'is_active']);

        if ($request->hasFile('photo')) {
            if ($official->photo) {
                Storage::disk('public')->delete($official->photo);
            }
            $data['photo'] = $request->file('photo')->store('officials', 'public');
        }

        $official->update($data);

        return response()->json([
            'message' => 'Official updated successfully',
            'official' => $official,
        ]);
    }

    public function destroy(Request $request, Official $official)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($official->photo) {
            Storage::disk('public')->delete($official->photo);
        }

        $official->delete();

        return response()->json(['message' => 'Official deleted successfully']);
    }
}
