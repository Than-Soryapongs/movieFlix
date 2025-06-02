<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 'user') {
            abort(404); // or redirect('/admin/dashboard');
        }

        return view('dashboard.user', compact('user'));
    }

    public function adminDashboard()
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            abort(404); // or redirect('/user/dashboard');
        }

        return view('dashboard.admin', compact('admin'));
    }
}
