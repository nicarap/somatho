<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\DataTransferObjects\traitmentDTO;
use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Http\Resources\TherapistResource;
use App\Models\Therapist;
use App\Services\TraitmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TraitmentController extends Controller
{
    public function __construct(private TraitmentService $traitmentService) {}

    public function store(StoreTraitmentRequest $request, Therapist $therapist)
    {
        $address = $therapist->address;

        $traitment = $this->traitmentService->create(traitmentDTO::from(array_merge($request->all(), [
            'label' => $address->label,
            'context' => $address->context,
            'postcode' => $address->postcode,
            'city' => $address->city,
            'price' => 70,
        ])));
            // $this->traitmentService->therapistValidation($traitment, Carbon::now());
            // $this->traitmentService->patientValidation($traitment, Carbon::now());

            // return back()->with(['flash'=> ['type' => 'error', 'message' => 'La réservation n\'a pas pu être créée']]);
        
        return redirect()->route('therapist.agenda', ['therapist' => $therapist])->with(['flash'=> ['type' => 'success', 'message' => 'Réservation créée']]);
        // return back()->with(['flash'=> ['type' => 'success', 'message' => 'Réservation créée']]);
    }
}
