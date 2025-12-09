<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $query = User::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(10);
        return response()->json($users);
    }

    public function show(Request $request, User $user)
    {
        if (!$request->user()->isAdmin() && $request->user()->id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        if (!$request->user()->isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'role' => 'sometimes|in:admin,superadmin,user',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['name', 'email', 'role', 'is_active']);
        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        if (!$request->user()->isSuperAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($user->id === $request->user()->id) {
            return response()->json(['message' => 'Cannot delete yourself'], 422);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function stats(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'active_users' => User::where('role', 'user')->where('is_active', true)->count(),
            'total_complaints' => $request->user()->complaints()->count(),
            'pending_complaints' => $request->user()->complaints()->where('status', 'pending')->count(),
            'total_documents' => $request->user()->documentRequests()->count(),
            'pending_documents' => $request->user()->documentRequests()->where('status', 'pending')->count(),
        ];

        return response()->json($stats);
    }
}
