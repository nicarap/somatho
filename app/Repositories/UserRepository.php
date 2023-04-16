<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Cache\Repository;
use App\DataTransferObjects\UserDTO;

class UserRepository extends Repository
{
    public function __construct()
    {
        
    }

    public function exists(User $user): bool
    {
        return true;
    }

    public function create(UserDTO $entity): User
    {
        return User::create($entity);;
    }
} 