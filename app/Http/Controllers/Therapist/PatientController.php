<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Resources\TherapistResource;
use App\Http\Resources\TraitmentResource;
use App\Http\Resources\UserResource;
use App\Models\Therapist;
use App\Models\Traitment;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function __construct(public UserService $userService)
    {
    }

    public function index(Request $request, Therapist $therapist)
    {
        return Inertia::render('Therapist/Patient/Index', [
            'therapist' => new TherapistResource($therapist->load('patients')),
            'policies' => [],
        ]);
    }

    public function create(Request $request, Therapist $therapist)
    {
        return Inertia::render('Therapist/Patient/Create', [
            'therapist' => new TherapistResource($therapist->load('patients')),
            'policies' => [],
        ]);
    }

    public function store(Request $request, Therapist $therapist)
    {
        DB::beginTransaction();

        try {
            $patient = $this->userService->create($request->all());
            $patient->therapists()->attach($therapist);

            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            report($e);
            DB::rollBack();

            return redirect()->back()->with(['flash' => ['type' => 'error', 'message' => 'Impossible d\'ajouter l\'adresse.']]);
        }

        return redirect()->back()->with(['flash' => ['type' => 'success', 'message' => 'Adresse ajoutée avec']]);
    }

    public function show(Request $request, Therapist $therapist, User $patient)
    {
        return Inertia::render('Therapist/Patient/Show', [
            'therapist' => new TherapistResource($therapist),
            'patient' => new UserResource($patient),
            'traitments' => new TraitmentResource($patient->therapistTraitments($therapist)->get()),
        ]);
    }
}
