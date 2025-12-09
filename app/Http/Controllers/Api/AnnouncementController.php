<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::with('creator');

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if (!$request->user() || !$request->user()->isAdmin()) {
            $query->where('is_active', true);
        }

        $announcements = $query->latest('published_at')->paginate(10);
        return response()->json($announcements);
    }

    public function store(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:255',
            'is_pinned' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $data = $request->only(['title', 'content', 'category', 'is_pinned', 'is_active', 'published_at']);
        $data['created_by'] = $request->user()->id;

        if (!isset($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('announcements', 'public');
            }
            $data['images'] = $paths;
        }

        $announcement = Announcement::create($data);

        return response()->json([
            'message' => 'Announcement created successfully',
            'announcement' => $announcement->load('creator'),
        ], 201);
    }

    public function show(Announcement $announcement)
    {
        return response()->json($announcement->load('creator'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'category' => 'nullable|string|max:255',
            'is_pinned' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'content', 'category', 'is_pinned', 'is_active', 'published_at']);

        $announcement->update($data);

        return response()->json([
            'message' => 'Announcement updated successfully',
            'announcement' => $announcement->load('creator'),
        ]);
    }

    public function destroy(Request $request, Announcement $announcement)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($announcement->images) {
            foreach ($announcement->images as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $announcement->delete();

        return response()->json(['message' => 'Announcement deleted successfully']);
    }
}
