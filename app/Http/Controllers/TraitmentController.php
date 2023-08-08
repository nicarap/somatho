<?php

namespace App\Http\Controllers;

use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Models\Traitment;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraitmentController extends Controller
{
    public function store(StoreTraitmentRequest $request)
    {
        $therapist = User::firstWhere('id', $request->get('therapist_id'));
        $address = $therapist->address;

        DB::beginTransaction();

        try {
            $t = Traitment::make(
                array_merge($request->all(), [
                    'therapist_validated_at' => Carbon::now(),
                    'patient_validated_at' => Carbon::now(),
                    'price' => 70,
                    'travel_cost' => 0,
                    'discount' => 0,
                    'location_choosed' => $address->location,
                    'address' => $address->address,
                    'postal_code' => $address->postal_code,
                    'location' => $address->location,
                ])
            );
            $t->therapist()->associate($therapist);
            $t->patient()->associate(User::firstWhere('id', $request->get('patient_id')));
            
            $t->save();
            DB::commit();
        }catch(Exception $e){
            dd($e);
            DB::rollBack();
        }

        return back()->with(['flash'=> ['type' => 'success', 'message' => 'Réservation créée']]);
    }

    public function update(Request $request, Traitment $traitment)
    {
        dd($traitment);
    }
}
