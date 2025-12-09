<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        
        // Get all data (when user auth is implemented, filter by appropriate scope)
        $allDocuments = DocumentRequest::all();
        $allComplaints = Complaint::all();
        
        // KPI Statistics
        $stats = [
            'totalUsers' => 0, // Placeholder - implement when user management is ready
            'totalResidents' => 0, // Placeholder
            'totalStaff' => 0, // Placeholder
            'archivedAccounts' => 0, // Placeholder
        ];
        
        // Population by Gender (Placeholder data)
        $populationByGender = [
            'male' => 700,
            'female' => 800,
        ];
        
        // Total Requests & Complaints for selected month
        $monthlyDocuments = DocumentRequest::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        
        $monthlyComplaints = Complaint::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        
        $requestsComplaints = [
            'documents' => $monthlyDocuments,
            'complaints' => $monthlyComplaints,
        ];
        
        // Most Requested Documents
        $mostRequestedDocs = DocumentRequest::select('document_type', DB::raw('count(*) as total'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('document_type')
            ->orderBy('total', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->document_type => $item->total];
            });
        
        // Ensure all document types are present
        $documentTypes = [
            'Barangay Clearance' => $mostRequestedDocs->get('Barangay Clearance', 0),
            'Barangay Certificate' => $mostRequestedDocs->get('Barangay Certificate', 0),
            'Indigency' => $mostRequestedDocs->get('Indigency', 0),
            'Certificate of Residency' => $mostRequestedDocs->get('Certificate of Residency', 0),
        ];
        
        // Request Status Summary
        $requestStatusSummary = [
            'pending' => DocumentRequest::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', 'pending')
                ->count(),
            'processing' => DocumentRequest::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', 'processing')
                ->count(),
            'approved' => DocumentRequest::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereIn('status', ['approved', 'rejected'])
                ->count(),
        ];
        
        // Most Reported Complaints
        $mostReportedComplaints = Complaint::select('complaint_type', DB::raw('count(*) as total'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('complaint_type')
            ->orderBy('total', 'desc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->complaint_type => $item->total];
            });
        
        // Group complaint types
        $complaintTypes = [
            'Noise Disturbances' => $mostReportedComplaints->get('Noise Disturbances', 0),
            'Illegal Parking' => $mostReportedComplaints->get('Illegal Parking', 0),
            'Improper Garbage Disposal' => $mostReportedComplaints->get('Improper Garbage Disposal', 0),
            'Others' => $mostReportedComplaints->except(['Noise Disturbances', 'Illegal Parking', 'Improper Garbage Disposal'])->sum(),
        ];
        
        // Complaints Status Summary
        $complaintsStatusSummary = [
            'pending' => Complaint::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', 'pending')
                ->count(),
            'investigating' => Complaint::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', 'investigating')
                ->count(),
            'resolved' => Complaint::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereIn('status', ['resolved', 'dismissed'])
                ->count(),
        ];
        
        // Get month name
        $monthName = date('F', mktime(0, 0, 0, $month, 1));
        
        return view('superadmin.reports.index', compact(
            'stats',
            'populationByGender',
            'requestsComplaints',
            'documentTypes',
            'requestStatusSummary',
            'complaintTypes',
            'complaintsStatusSummary',
            'year',
            'month',
            'monthName'
        ));
    }
    
    public function export(Request $request)
    {
        $type = $request->get('type', 'all');
        $year = $request->get('year', date('Y'));
        $month = $request->get('month');
        
        // This is a placeholder for export functionality
        // You can implement PDF or Excel export here using packages like:
        // - dompdf/dompdf for PDF
        // - maatwebsite/excel for Excel
        
        return redirect()->back()->with('success', 'Export functionality will be implemented soon.');
    }
}
