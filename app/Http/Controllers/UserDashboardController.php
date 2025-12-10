<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    public function index()
    {
        // User dashboard logic here
        return view('user.dashboard.index');
    }
}
