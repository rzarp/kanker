<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    User,
    Patient
};

class DashboardController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function dashboard()
    {
        return view('admin-master.dashboard', [
            'count_doctor' => User::where('role', 'DOKTER')->get()->count(),
            'count_it' => User::where('role', 'ADMIN')->get()->count(),
            'count_patient' => Patient::all()->count()
        ]);
    }
}
