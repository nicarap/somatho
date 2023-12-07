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
        public string $address_id,
        public DateTime $programmed_start_at,
        public DateTime $programmed_end_at,
        public string $price,

        #[WithCast(DateTimeInterfaceCast::class)]
        public DateTime|Optional $therapist_validated_at,
        #[WithCast(DateTimeInterfaceCast::class)]
        public DateTime|Optional $patient_validated_at,
        public float|Optional $travel_cost,
        public float|Optional $discount,
        public string|Optional $complement_address,
    ) {
    }
}
