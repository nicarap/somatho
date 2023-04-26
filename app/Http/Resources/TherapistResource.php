<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TherapistResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return array_merge(parent::toArray($request), [
            'policies' => [
                'view' => true,
                'update' => true,
                'delete' => true,
            ]
        ]);
    }
}