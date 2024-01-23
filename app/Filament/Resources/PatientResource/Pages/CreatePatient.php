<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use App\Models\Address;
use Illuminate\Support\Arr;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $addresses = collect(session("addresses", []));
        try {
            $attributes = $addresses->firstOrFail(fn ($value, $index) => $index == $data["address"]);

            $address = Address::create(array_merge($attributes, [
                "longitude" => Arr::get($attributes, "x"),
                "latitude" => Arr::get($attributes, "y"),
                "is_verified" => true,
            ]));

            $data["address_id"] = $address->id;
        } catch (\Exception $e) {
            dd($e);
            logger()->error($e->getMessage());
        }

        return static::getModel()::create($data);
    }
}
