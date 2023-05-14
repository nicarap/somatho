<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Inertia\Inertia;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if($user->isTherpist()) return redirect(route('profile.therapist.show', ['therapist' => $user->id]));
        if($user->isPatient()) return redirect(route('profile.patient.show', ['patient' => $user->id]));
        
        return Inertia::render('Dashboard', [
            'user' => new UserResource($user),
        ]);
    }
}
