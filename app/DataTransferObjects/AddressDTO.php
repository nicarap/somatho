<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\WithCast;

class AddressDTO extends Data
{
    public function __construct(
        public String $label,
        public String $name,
        public String $context,
        public String $postcode,
        public String $city,
        public String $longitude,
        public String $latitude,
        public bool $is_verified,
        public bool $default,
    )
    {
        
    }
    
}