<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\DataTransferObjects\traitmentDTO;
use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Models\Therapist;
use App\Services\TraitmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TraitmentController extends Controller
{
    public function __construct(private TraitmentService $traitmentService) {}

    public function store(StoreTraitmentRequest $request)
    {
        $therapist = Therapist::firstWhere('id', $request->get('therapist_id'));
        $address = $therapist->address;

        if($traitment = $this->traitmentService->create(traitmentDTO::from(array_merge($request->all(), [
            'location_choosed' => $address->location,
            'address' => $address->address,
            'postal_code' => $address->postal_code,
            'location' => $address->location,
            'price' => 70,
        ])))){
            $this->traitmentService->therapistValidation($traitment, Carbon::now());
            $this->traitmentService->patientValidation($traitment, Carbon::now());

            return back()->with(['flash'=> ['type' => 'success', 'message' => 'Réservation créée']]);
        }else{
            return back()->with(['flash'=> ['type' => 'error', 'message' => 'La réservation n\'a pas pu être créée']]);
        }
    }
}
