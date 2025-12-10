<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;

class AdminDocumentRequestController extends Controller
{
    // Superadmin: View all document requests
    public function index()
    {
        $requests = DocumentRequest::orderBy('created_at', 'desc')->get();
        return view('superadmin.documents.index', compact('requests'));
    }

    // Superadmin: Update request status
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $documentRequest = DocumentRequest::findOrFail($id);
        $documentRequest->update($validated);

        return redirect()->back()->with('success', 'Request status updated successfully!');
    }
}
