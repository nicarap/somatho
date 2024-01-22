<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\UserAddress;

class UserAddressRepository
{
    public function update(UserAddress $user_address, array $attributes)
    {
        return $user_address->update($attributes);
    }

    public function updateDefaultAttribute(UserAddress $user_address, bool $value)
    {
        $user_address->default = $value;
        $user_address->save();
        
        return $user_address;
    }
} 