<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminComplaintController extends Controller
{
    // Superadmin: View all complaints
    public function index()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        return view('superadmin.complaints.index', compact('complaints'));
    }

    // Superadmin: Update complaint status
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update($validated);

        return redirect()->back()->with('success', 'Complaint status updated successfully!');
    }
}
