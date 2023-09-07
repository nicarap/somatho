<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\traitmentDTO;
use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Models\Therapist;
use App\Models\Traitment;
use App\Models\User;
use App\Services\TraitmentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraitmentController extends Controller
{

    public function __construct(private TraitmentService $traitmentService)
    {


    }
    public function store(StoreTraitmentRequest $request)
    {
        DB::beginTransaction();
        
        $therapist = Therapist::firstWhere('id', $request->get('therapist_id'));
        $address = $therapist->addresses()->first();
        
        try{
            $traitment = $this->traitmentService->create(traitmentDTO::from(array_merge($request->all(), [
                'label' => $address->label,
                'context' => $address->context,
                'postcode' => $address->postcode,
                'city' => $address->city,
                'price' => 70,
            ])));
            $this->traitmentService->therapistValidation($traitment, Carbon::now());
            $this->traitmentService->patientValidation($traitment, Carbon::now());
            
            DB::commit();
        }catch(\Exception $e){
            report($e);
            DB::rollBack();

            return back()->with(['flash'=> ['type' => 'error', 'message' => 'La réservation n\'a pas pu être créée']]);
        }

        return back()->with(['flash'=> ['type' => 'success', 'message' => 'Réservation créée']]);
    }

    public function update(Request $request, Traitment $traitment)
    {
        dd($traitment);
    }
}
