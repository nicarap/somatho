<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if($user->isTherpist()) redirect('therapist.dashboard');
        if($user->isPatient()) redirect('patient.dashboard');
        return Inertia::render('Dashboard');
    }
}
