<?php

namespace App\Http\Resources;

use App\Models\Therapist;
use App\Models\Traitment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return array_merge(parent::toArray($request), [
            'therapist' => TherapistResource::collection($this->whenLoaded('therapist')),
            'traitments' => TraitmentResource::collection($this->whenLoaded('traitments')),
            'next_traitment' => $this->when($request->route('therapist'), 
                new TraitmentResource(Traitment::forTherapist($request->route('therapist'))->forPatient($this->resource)->nextTraitment()->first())),
            'policies' => [
                'view' => true,
                'delete' => true,
            ]
        ]);
    }
}