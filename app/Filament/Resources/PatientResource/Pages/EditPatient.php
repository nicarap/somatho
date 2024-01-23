<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PatientResource;
use App\Models\Address;

class EditPatient extends EditRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
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
                if (count($addresses) > 0 && $data["address"]) {
                    $attributes = $addresses->firstOrFail(fn ($value, $index) => $index == $data["address"]);

                    $address = Address::create(array_merge($attributes, [
                        "longitude" => Arr::get($attributes, "x"),
                        "latitude" => Arr::get($attributes, "y"),
                        "is_verified" => true,
                    ]));
                }
            }

            $record->update($data);
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
        }

        return $record;
    }
}
