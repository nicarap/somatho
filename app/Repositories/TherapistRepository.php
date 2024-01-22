<?php

declare(strict_types=1);

namespace App\Repositories;
use App\Models\Address;
use App\Models\Therapist;

class TherapistRepository
{
    public function attachAddress(Therapist $therapist, Address $address)
    {
        $therapist->addresses()->attach($address, ['model_type' => Therapist::class]);
    }
} 