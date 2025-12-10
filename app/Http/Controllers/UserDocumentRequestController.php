<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;

class UserDocumentRequestController extends Controller
{
    // User: View document request form
    public function userIndex()
    {
        $requests = DocumentRequest::orderBy('created_at', 'desc')->get();
        
        $stats = [
            'pending' => $requests->where('status', 'pending')->count(),
            'processing' => $requests->where('status', 'processing')->count(),
            'approved' => $requests->where('status', 'approved')->count(),
        ];
        
        return view('user.document-req.index', compact('requests', 'stats'));
    }

    // User: Submit document request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|string|max:255',
            'requester_name' => 'required|string|max:255',
            'requester_email' => 'nullable|email|max:255',
            'requester_phone' => 'nullable|string|max:20',
            'purpose' => 'required|string'
        ]);

        DocumentRequest::create($validated);

        return redirect()->back()->with('success', 'Document request submitted successfully!');
    }

}
