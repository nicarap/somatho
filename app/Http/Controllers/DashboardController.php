<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Therapist;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if($user instanceof(Therapist::class)) return redirect(route('therapist.dashboard', ['therapist' => $user->id]));
        if($user instanceof(User::class)) {
            // TODO : Redirect public view blade
            // return redirect(route('profile.patient.show', ['patient' => $user->id]));
            abort(404);
        }
        
        return Inertia::render('Dashboard', [
            'user' => new UserResource($user),
        ]);
    }
}
