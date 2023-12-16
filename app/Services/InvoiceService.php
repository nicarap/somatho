<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\Therapist;
use App\Models\Traitment;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\DataTransferObjects\UserDTO;
use App\Exceptions\UserAlreadyExist;
use App\Repositories\UserRepository;
use App\Repositories\InvoiceRepository;

class InvoiceService
{
    public function __construct(private InvoiceRepository $invoiceRepository)
    {
    }

    public function create(array $attributes): Invoice
    {
        $invoice = $this->invoiceRepository->make(array_merge($attributes, [
            "number" => $this->generateUniqueNumber(),
        ]));

        $invoice->traitment()->associate(Traitment::find(Arr::get($attributes, "traitment_id")))->save();

        return $invoice;
    }

    private function generateUniqueNumber(): string
    {
        $number = "F_" . mb_strtoupper(Str::random(4));
        $count = 0;

        $invoice_number = $number . str_pad((string) $count, 2, "0", STR_PAD_LEFT);
        logger()->info("Invoice number $invoice_number");
        while (Invoice::findByNumber($invoice_number) !== null) {
            logger()->info("Invoice number $invoice_number already exist");
            $count++;
        }

        return $number . str_pad((string) $count, 2, "0", STR_PAD_LEFT);
    }
}
