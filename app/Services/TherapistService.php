<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\UserDTO;
use App\Exceptions\UserAlreadyExist;
use App\Models\Address;
use App\Models\Therapist;
use App\Models\User;
use App\Repositories\TherapistRepository;
use App\Repositories\UserRepository;
use Exception;

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