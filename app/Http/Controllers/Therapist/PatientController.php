<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\UserResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\User;

class PatientController extends Controller
{
    public function index(Request $request, User $therapist)
    {
        return Inertia::render('Therapist/User/Index', [
            'patients' => UserResource::collection(
                QueryBuilder::for(User::hasTherapist($therapist))
                    ->paginate()
                    ->appends($request->query())
            ),
            'policies' => [],
        ]);
    }
}
