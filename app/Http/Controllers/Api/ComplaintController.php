<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Complaint::with('user');

        // Filter by user if not admin
        if (!$request->user()->isAdmin()) {
            $query->where('user_id', $request->user()->id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('complaint_type', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $complaints = $query->latest()->paginate(10);

        return response()->json($complaints);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'complaint_type' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'attachments.*' => 'nullable|file|max:5120',
        ]);

        $data = $request->only(['complaint_type', 'subject', 'description', 'location']);
        $data['user_id'] = $request->user()->id;

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            $paths = [];
            foreach ($request->file('attachments') as $file) {
                $paths[] = $file->store('complaints', 'public');
            }
            $data['attachments'] = $paths;
        }

        $complaint = Complaint::create($data);

        return response()->json([
            'message' => 'Complaint submitted successfully',
            'complaint' => $complaint->load('user'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Complaint $complaint)
    {
        // Check authorization
        if (!$request->user()->isAdmin() && $complaint->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($complaint->load('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        // Users can only update their own pending complaints
        if (!$request->user()->isAdmin() && 
            ($complaint->user_id !== $request->user()->id || $complaint->status !== 'pending')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'complaint_type' => 'sometimes|required|string|max:255',
            'subject' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'location' => 'nullable|string|max:255',
            'status' => 'sometimes|in:pending,in_progress,resolved,rejected',
            'admin_response' => 'nullable|string',
        ]);

        $data = $request->only(['complaint_type', 'subject', 'description', 'location']);

        // Only admins can update status and add responses
        if ($request->user()->isAdmin()) {
            if ($request->has('status')) {
                $data['status'] = $request->status;
            }
            if ($request->has('admin_response')) {
                $data['admin_response'] = $request->admin_response;
            }
            if ($request->status === 'resolved') {
                $data['resolved_at'] = now();
            }
        }

        $complaint->update($data);

        return response()->json([
            'message' => 'Complaint updated successfully',
            'complaint' => $complaint->load('user'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Complaint $complaint)
    {
        // Only users can delete their own pending complaints or admins can delete any
        if (!$request->user()->isAdmin() && 
            ($complaint->user_id !== $request->user()->id || $complaint->status !== 'pending')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Delete attachments
        if ($complaint->attachments) {
            foreach ($complaint->attachments as $path) {
                Storage::disk('public')->delete($path);
            }
        }

        $complaint->delete();

        return response()->json([
            'message' => 'Complaint deleted successfully',
        ]);
    }
}
