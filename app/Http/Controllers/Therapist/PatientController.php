<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\PatientResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Patient;
use App\Models\Therapist;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $therapist = Therapist::find($request->user()->id);
        return Inertia::render('Therapist/Patient/Index', [
            'patients' => PatientResource::collection(
                QueryBuilder::for(Patient::hasTherapist($therapist))
                    ->paginate()
                    ->appends($request->query())
            ),
            'policies' => [],
        ]);
    }
}
