<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    // User: View complaint form and list
    public function userIndex()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        
        $stats = [
            'pending' => $complaints->where('status', 'pending')->count(),
            'investigating' => $complaints->where('status', 'investigating')->count(),
            'resolved' => $complaints->where('status', 'resolved')->count(),
        ];
        
        return view('user.complaint-files.index', compact('complaints', 'stats'));
    }

    // User: Submit complaint
    public function store(Request $request)
    {
        $validated = $request->validate([
            'complaint_type' => 'required|string|max:255',
            'complainant_name' => 'required|string|max:255',
            'complainant_email' => 'nullable|email|max:255',
            'complainant_phone' => 'nullable|string|max:20',
            'complaint_details' => 'required|string',
            'respondent_name' => 'nullable|string|max:255'
        ]);

        Complaint::create($validated);

        return redirect()->back()->with('success', 'Complaint filed successfully!');
    }

    // Superadmin: View all complaints
    public function superadminIndex()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        return view('superadmin.complaints.index', compact('complaints'));
    }

    // Superadmin: Update complaint status
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,investigating,resolved,dismissed',
            'admin_notes' => 'nullable|string'
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update($validated);

        return redirect()->back()->with('success', 'Complaint status updated successfully!');
    }
}
