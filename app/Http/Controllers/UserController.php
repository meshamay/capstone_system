<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // For now, since the database doesn't have gender/status fields,
        // we'll return basic counts. You can update the migration later to add these fields.
        $users = User::all();
        
        $stats = [
            'totalResidents' => $users->count(),
            'totalMale' => 0, // Will need gender column in users table
            'totalFemale' => 0, // Will need gender column in users table
            'totalArchived' => 0, // Will need status column in users table
        ];
        
        return view('superadmin.users.index', compact('stats', 'users'));
    }
}
