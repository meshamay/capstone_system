<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentRequest;
use Illuminate\Http\Request;

class DocumentRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentRequest::with('user');

        if (!$request->user()->isAdmin()) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('document_type', 'like', '%' . $request->search . '%')
                  ->orWhere('purpose', 'like', '%' . $request->search . '%')
                  ->orWhere('tracking_number', 'like', '%' . $request->search . '%');
            });
        }

        $documents = $query->latest()->paginate(10);
        return response()->json($documents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'required_info' => 'nullable|array',
        ]);

        $data = $request->only(['document_type', 'purpose', 'required_info']);
        $data['user_id'] = $request->user()->id;

        $document = DocumentRequest::create($data);

        return response()->json([
            'message' => 'Document request submitted successfully',
            'document' => $document->load('user'),
        ], 201);
    }

    public function show(Request $request, DocumentRequest $documentRequest)
    {
        if (!$request->user()->isAdmin() && $documentRequest->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($documentRequest->load('user'));
    }

    public function update(Request $request, DocumentRequest $documentRequest)
    {
        if (!$request->user()->isAdmin() && $documentRequest->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'sometimes|in:pending,processing,ready,claimed,rejected',
            'fee' => 'sometimes|numeric|min:0',
            'payment_status' => 'sometimes|boolean',
            'remarks' => 'nullable|string',
        ]);

        if ($request->user()->isAdmin()) {
            $data = $request->only(['status', 'fee', 'payment_status', 'remarks']);
            if ($request->status === 'claimed') {
                $data['claimed_at'] = now();
            }
            $documentRequest->update($data);
        }

        return response()->json([
            'message' => 'Document request updated successfully',
            'document' => $documentRequest->load('user'),
        ]);
    }

    public function destroy(Request $request, DocumentRequest $documentRequest)
    {
        if (!$request->user()->isAdmin() && 
            ($documentRequest->user_id !== $request->user()->id || $documentRequest->status !== 'pending')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $documentRequest->delete();
        return response()->json(['message' => 'Document request deleted successfully']);
    }

    public function track(Request $request)
    {
        $request->validate(['tracking_number' => 'required|string']);

        $document = DocumentRequest::where('tracking_number', $request->tracking_number)->first();

        if (!$document) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        return response()->json($document);
    }
}
