<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\AddressDTO;
use App\Models\User;
use App\DataTransferObjects\UserDTO;
use App\Models\Address;

class AddressRepository
{
    public function create(AddressDTO $addressDTO)
    {
        return Address::create($addressDTO);
    }

    public function delete(Address $address)
    {
        return $address->delete();
    }
} 