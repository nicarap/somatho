<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Patient/Index', [
            'patients' => PatientResource::collection(
                QueryBuilder::for(Patient::class)
                    ->paginate()
                    ->appends($request->query())
            ),
            'policies' => [
                'create' => true,
            ]
        ]);
    }
    
}
