<?php

namespace App\Http\Controllers;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Admin dashboard logic here
        return view('superadmin.dashboard.index');
    }
}
