<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\DataTransferObjects\UserDTO;
use App\Models\Address;

class AddressRepository
{
    public function create(array $attributes)
    {
        return Address::create($attributes);
    }

    public function destroy(Address $address)
    {
        return $address->delete();
    }
} 