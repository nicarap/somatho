<?php

namespace App\Http\Controllers;

use App\Http\Resources\TherapistResource;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Therapist;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Therapist/Index', [
            'therapists' => TherapistResource::collection(
                QueryBuilder::for(Therapist::class)
                    ->paginate()
                    ->appends($request->query())
            ),
            'policies' => [
                'create' => true,
            ]
        ]);
    }
}
