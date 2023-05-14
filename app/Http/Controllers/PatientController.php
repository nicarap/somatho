<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Patient::class, 'patient');
    }

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

    public function show(Request $request, Patient $patient){
        
        return Inertia::render('Patient/Show', [
            'patient' => new PatientResource($patient->load('patientInfo')),
        ]);
    }
    
}
