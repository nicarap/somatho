<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return array_merge(parent::toArray($request), [
            'therapist' => UserResource::collection($this->whenLoaded('therapist')),
            'traitments' => UserResource::collection($this->whenLoaded('traitments')),
            'policies' => [
                'view' => true,
                'delete' => true,
            ]
        ]);
    }
}