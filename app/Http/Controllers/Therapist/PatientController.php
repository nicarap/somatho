<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Resources\TherapistResource;
use App\Models\Therapist;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index(Request $request, Therapist $therapist)
    {
        return Inertia::render('Therapist/Patient/Index', [
            'therapist' => new TherapistResource($therapist->load('patients')),
            'policies' => [],
        ]);
    }
}
