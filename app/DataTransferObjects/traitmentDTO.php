<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use DateTime;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class traitmentDTO extends Data
{
    public function __construct(
        public string $therapist_id,
        public string $patient_id,
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i')]
        public DateTime $programmed_start_at,
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i')]
        public DateTime $programmed_end_at,
        public string $price,
        public string $label,
        public string $context,
        public string $postcode,
        public string $city,

        #[WithCast(DateTimeInterfaceCast::class)]
        public DateTime|Optional $therapist_validated_at,
        #[WithCast(DateTimeInterfaceCast::class)]
        public DateTime|Optional $patient_validated_at,
        public float|Optional $travel_cost,
        public float|Optional $discount,
        public string|Optional $complement_address,
    )
    {
        
    }
    
}