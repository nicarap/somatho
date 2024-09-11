<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use App\Models\Address;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PatientResource;
use App\Jobs\GenerateInvoiceJob;
use App\Models\Therapist;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;

class EditPatient extends EditRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('action')
                ->label("Générer une facture")
                ->action(function (User $record, array $data) {
                    GenerateInvoiceJob::dispatch(Therapist::first(), $record, Carbon::parse($data['date']))->onQueue("invoice");
                })
                ->form([
                    DatePicker::make('date'),
                ])
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            if ($data["manual_address"]) {
                $address = Address::create([
                    "name" => $data["address_name"],
                    "street" => $data["address_street"],
                    "context" => $data["address_context"],
                    "postcode" => $data["address_postcode"],
                    "city" => $data["address_city"],
                ]);

                $data["address_id"] = $address->id;
            } else {
                $addresses = collect(session("addresses", []));
                if (count($addresses) > 0 && $data["address"] !== null) {
                    $attributes = $addresses->firstOrFail(fn($value, $index) => intval($index) === intval($data["address"]));

                    $address = Address::create(array_merge($attributes, [
                        "longitude" => Arr::get($attributes, "x"),
                        "latitude" => Arr::get($attributes, "y"),
                        "is_verified" => true,
                    ]));

                    $data["address_id"] = $address->id;
                }
            }

            $record->update($data);
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
        }

        return $record;
    }
}
