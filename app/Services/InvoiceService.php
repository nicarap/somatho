<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Invoice;
use App\Models\Therapist;
use App\Models\Traitment;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Repositories\InvoiceRepository;
use Carbon\Carbon;

class InvoiceService
{
    public function __construct(private InvoiceRepository $invoiceRepository) {}

    public function create(Therapist $therapist, User $patient, Carbon $start_at): Invoice
    {
        $traitments = $patient
            ->traitments()
            ->forTherapist($therapist)
            ->notBilledYet()
            ->startAt($start_at->startOfMonth())
            ->endAt($start_at->endOfMonth())
            ->get();

        $attributes = [
            "therapist_street" => $therapist->address->street,
            "therapist_context" => $therapist->address->context,
            "therapist_postcode" => $therapist->address->postcode,
            "therapist_city" => $therapist->address->city,
            "patient_street" => $patient->address->street,
            "patient_context" => $patient->address->context,
            "patient_postcode" => $patient->address->postcode,
            "patient_city" => $patient->address->city,
            "start_at" => $start_at->startOfMonth(),
            "end_at" => $start_at->endOfMonth()
        ];

        $invoice = $this->invoiceRepository->make(array_merge($attributes, [
            "number" => $this->generateUniqueNumber(),
        ]));

        $invoice->therapist()->associate($therapist);
        $invoice->patient()->associate($patient);

        $invoice->save();

        $invoice->traitments()->saveMany($traitments);

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
