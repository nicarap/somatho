<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\UserDTO;
use App\Exceptions\UserAlreadyExist;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
        
    }

    public function create(UserDTO $entity): User
    {
        if(!$this->exist($entity)) throw new UserAlreadyExist(User::find($entity->id));

        return $this->userRepository->create($entity);
    }

    public function exist(UserDTO|User $entity): bool
    {
        return User::find($entity->id);
    }
}