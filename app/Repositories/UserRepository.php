<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\DataTransferObjects\UserDTO;

class UserRepository
{
    public function create(UserDTO $entity): User
    {
        return User::create($entity->toArray());;
    }
} 