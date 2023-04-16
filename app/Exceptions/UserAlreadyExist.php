<?php

namespace App\Exceptions;

use App\Models\User;
use Exception;

class UserAlreadyExist extends Exception
{
    public function __construct(protected User $user)
    {
        
    }

    public function getUser()
    {
        return $this->user;
    }
}
