<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\DataTransferObjects\UserDTO;
use App\Exceptions\UserAlreadyExist;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function create(UserDTO $entity): User
    {
        if ($this->exist($entity)) throw new UserAlreadyExist(User::findByEmail($entity->email));

        $user = $this->userRepository->create($entity);

        return $user;
    }

    public function exist(UserDTO|User $entity): User|null
    {
        return User::findByEmail($entity->email);
    }
}
