<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{   
    public function login() { 
        return view ('auth.login');

    }
    public function dashboard() { 
        return view ('admin-master.dashboard');
    }
    public function inputpasien() { 
        return view ('admin-master.input-pasien');
    }
    public function datapasien() { 
        return view ('admin-master.data-pasien');
    }

    public function inputregispasien() { 
        return view ('admin-master.input-regis');
    }
     public function dataregis() { 
        return view ('admin-master.data-regis');
    }
}
