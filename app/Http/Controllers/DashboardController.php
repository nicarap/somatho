<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if($user->isTherapist()) return redirect(route('profile.therapist.show', ['therapist' => $user->id]));
        if($user->isPatient()) {
            // TODO : Redirect public view blade
            // return redirect(route('profile.patient.show', ['patient' => $user->id]));
            abort(404);
        }
        
        return Inertia::render('Dashboard', [
            'user' => new UserResource($user),
        ]);
    }
}
