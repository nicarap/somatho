<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use App\Models\Address;
use Illuminate\Support\Arr;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;
use App\Services\AddressService;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    protected function handleRecordCreation(array $data): Model
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

            $data["address_id"] = $address->id;
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
        }

        return static::getModel()::create($data);
    }
}
