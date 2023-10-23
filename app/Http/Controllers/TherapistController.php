<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\TherapistResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Therapist;
use App\Models\Traitment;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\QueryBuilder\AllowedFilter;
use Inertia\Response;
use Carbon\Carbon;

class TherapistController extends Controller
{
    public function dashboard(Request $request, Therapist $therapist): Response
    {

        return Inertia::render('Therapist/Dashboard', [
            'therapist' => $therapist,
            'traitments_by' => [
                'week' => [
                    'count' => $therapist->traitments()->startAt(Carbon::now()->startOfWeek())->endAt(Carbon::now()->endOfWeek())->count(),
                    'date' => Carbon::now()->week()
                ],
                'day' => [
                    'count' => $therapist->traitments()->startAt(Carbon::now())->endAt(Carbon::now())->count(),
                    'date' => Carbon::now(),
                ]
            ],
            'next_traitment' => Traitment::forTherapist($therapist)->nextTraitment()->first()?->load('patient')
        ]);
    }

    public function index(Request $request, Therapist $therapist): Response
    {
        return Inertia::render('Therapist/User/Index', [
            'Users' => TherapistResource::collection(
                QueryBuilder::for(Therapist::hasTherapist($therapist))
                    ->paginate()
                    ->appends($request->query())
            ),
            'policies' => [],
        ]);
    }

    public function agenda(Request $request, Therapist $therapist): Response
    {
        return Inertia::render('Therapist/Agenda', [
            'therapist' => new TherapistResource($therapist),
            'traitments' => Inertia::lazy(fn () =>
            QueryBuilder::for(Traitment::forTherapist($therapist)->with(['patient:id,name', 'address:id,name']))
                ->allowedFilters([
                    AllowedFilter::scope('start_at'),
                    AllowedFilter::scope('end_at'),
                ])
                ->get())
        ]);
    }

    /**
     * Display the therapist's profile form.
     */
    public function edit(Request $request, Therapist $therapist): Response
    {
        return Inertia::render('Therapist/Edit', [
            'therapist' => new TherapistResource($therapist->load('addresses')),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
