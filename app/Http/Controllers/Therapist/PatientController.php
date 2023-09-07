<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Resources\TherapistResource;
use App\Http\Resources\TraitmentResource;
use App\Http\Resources\UserResource;
use App\Models\Therapist;
use App\Models\Traitment;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index(Request $request, Therapist $therapist)
    {
        $request['nextTraitmentFortherapist'] = $therapist;
        return Inertia::render('Therapist/Patient/Index', [
            'therapist' => new TherapistResource($therapist->load('patients')),
            'policies' => [],
        ]);
    }

    public function show(Request $request, Therapist $therapist, User $patient)
    {
        // dd($patient->therapistTraitments($therapist)->get());
        return Inertia::render('Therapist/Patient/Show', [
            'therapist' => new TherapistResource($therapist),
            'patient' => new UserResource($patient),
            'traitments' => new TraitmentResource($patient->therapistTraitments($therapist)->get()),
        ]);
    }
}
