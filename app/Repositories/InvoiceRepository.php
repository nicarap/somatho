<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepository
{
    public function make(array $attributes): Invoice
    {
        return new Invoice($attributes);
    }
}
