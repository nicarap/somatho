<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\Therapist;
use App\Repositories\TherapistRepository;

class TherapistService
{
    public function __construct(private TherapistRepository $therapistRepository)
    {
        
    }

    public function attachAdress(Therapist $therapist, Address $address)
    {
        return $this->therapistRepository->attachAddress($therapist, $address);
    }
}