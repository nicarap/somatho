<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use App\DataTransferObjects\RolesDTO;
use Spatie\LaravelData\Optional;

class UserDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        #[Unique('users', 'email')]
        public string $email,
        public string $password,
        public RolesDTO|Optional $roles,
    )
    {
        
    }
    
}