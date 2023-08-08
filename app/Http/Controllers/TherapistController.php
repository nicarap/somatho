<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\UserResource;
use App\Models\Traitment;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\QueryBuilder\AllowedFilter;
use Inertia\Response;
use App\Models\User;
use Spatie\LaravelData\Support\Lazy\InertiaLazy;

class TherapistController extends Controller
{
    public function dashboard(Request $request): Response
    {
        $therapist = $request->user();

        return Inertia::render('Therapist/Dashboard', [
            'therapist' => new UserResource($therapist),
        ]);
    }

    public function index(Request $request): Response
    {
        $therapist = User::find($request->user()->id);
        return Inertia::render('Therapist/User/Index', [
            'Users' => UserResource::collection(
                QueryBuilder::for(User::hasTherapist($therapist))
                    ->paginate()
                    ->appends($request->query())
            ),
            'policies' => [],
        ]);
    }

    public function agenda(Request $request, User $therapist): Response
    {
        return Inertia::render('Therapist/Agenda', [
            'therapist' => $therapist,
            'traitments' => Inertia::lazy(fn () => QueryBuilder::for(Traitment::forTherapist($therapist)->with('patient:id,name'))
                ->allowedFilters([
                    AllowedFilter::scope('starts_after'),
                    AllowedFilter::scope('end_before'),
                ])
                ->get())
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, User $therapist): Response
    {
        return Inertia::render('Therapist/Edit', [
            'therapist' => new UserResource($therapist),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
