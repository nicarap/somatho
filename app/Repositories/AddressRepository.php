<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    public function create(array $address)
    {
        return Address::create($address);
    }

    public function delete(Address $address)
    {
        return $address->delete();
    }
} 