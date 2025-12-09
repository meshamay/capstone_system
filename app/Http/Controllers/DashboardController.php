<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Complaint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get all document requests and complaints
        $documentRequests = DocumentRequest::orderBy('created_at', 'desc')->get();
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        
        // Combine both collections
        $allRecords = collect();
        
        // Add document requests with type identifier
        foreach ($documentRequests as $doc) {
            $allRecords->push([
                'id' => $doc->id,
                'type' => 'Document Request',
                'transaction_id' => 'DOC-' . str_pad($doc->id, 5, '0', STR_PAD_LEFT),
                'name' => $doc->requester_name,
                'description' => $doc->document_type,
                'date_filed' => $doc->created_at,
                'date_completed' => ($doc->status == 'approved' || $doc->status == 'rejected') ? $doc->updated_at : null,
                'status' => $doc->status,
                'original' => $doc
            ]);
        }
        
        // Add complaints with type identifier
        foreach ($complaints as $complaint) {
            $allRecords->push([
                'id' => $complaint->id,
                'type' => 'Complaint',
                'transaction_id' => 'CMP-' . str_pad($complaint->id, 5, '0', STR_PAD_LEFT),
                'name' => $complaint->complainant_name,
                'description' => $complaint->complaint_type,
                'date_filed' => $complaint->created_at,
                'date_completed' => $complaint->status == 'resolved' ? $complaint->updated_at : null,
                'status' => $complaint->status,
                'original' => $complaint
            ]);
        }
        
        // Sort by date filed (most recent first)
        $allRecords = $allRecords->sortByDesc('date_filed');
        
        // Calculate statistics
        $stats = [
            'totalUsers' => 0, // You can update this when user management is implemented
            'totalRequests' => $documentRequests->count(),
            'totalComplaints' => $complaints->count(),
            'totalCompleted' => $documentRequests->whereIn('status', ['approved', 'rejected'])->count() + 
                                $complaints->where('status', 'resolved')->count()
        ];
        
        return view('superadmin.dashboard.index', compact('allRecords', 'stats'));
    }
}
