<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\DataTransferObjects\UserDTO;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\Therapist;

class InvoiceRepository
{
    public function make(array $attributes): Invoice
    {
        return new Invoice($attributes);
    }
}
