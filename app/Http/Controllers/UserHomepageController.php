<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Complaint;
use Illuminate\Http\Request;

class UserHomepageController extends Controller
{
    public function index()
    {
        // Get recent document requests and complaints
        // Note: When user authentication is implemented, filter by current user
        $documentRequests = DocumentRequest::orderBy('created_at', 'desc')->take(10)->get();
        $complaints = Complaint::orderBy('created_at', 'desc')->take(10)->get();
        
        // Combine both collections for recent activity
        $recentActivity = collect();
        
        // Add document requests
        foreach ($documentRequests as $doc) {
            $recentActivity->push([
                'id' => $doc->id,
                'type' => 'Document Request',
                'transaction_id' => 'DOC-' . str_pad($doc->id, 5, '0', STR_PAD_LEFT),
                'title' => 'Request: ' . $doc->document_type,
                'date' => $doc->created_at,
                'status' => $doc->status,
                'date_text' => 'Req ' . $doc->created_at->format('M d, Y')
            ]);
        }
        
        // Add complaints
        foreach ($complaints as $complaint) {
            $recentActivity->push([
                'id' => $complaint->id,
                'type' => 'Complaint',
                'transaction_id' => 'CMP-' . str_pad($complaint->id, 5, '0', STR_PAD_LEFT),
                'title' => $complaint->complaint_type,
                'date' => $complaint->created_at,
                'status' => $complaint->status,
                'date_text' => 'Filed ' . $complaint->created_at->format('M d, Y')
            ]);
        }
        
        // Sort by date (most recent first) and take only first 5
        $recentActivity = $recentActivity->sortByDesc('date')->take(5);
        
        // Calculate statistics
        $stats = [
            'totalDocuments' => $documentRequests->count(),
            'pendingDocuments' => $documentRequests->where('status', 'pending')->count(),
            'totalComplaints' => $complaints->count(),
            'pendingComplaints' => $complaints->where('status', 'pending')->count(),
        ];
        
        return view('user.homepage.index', compact('recentActivity', 'stats'));
    }
}
