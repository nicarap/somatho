<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;

class RolesDTO extends Data
{
    public function __construct(
        public array $roles_id,
    )
    {
        
    }
    
}