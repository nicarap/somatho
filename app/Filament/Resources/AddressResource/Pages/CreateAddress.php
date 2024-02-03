<?php

namespace App\Filament\Resources\AddressResource\Pages;

use Filament\Actions;
use App\Models\Address;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AddressResource;

class CreateAddress extends CreateRecord
{
    protected static string $resource = AddressResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        if ($data["manual_address"] === false) {
            $addresses = collect(session("addresses", []));
            if (count($addresses) > 0 && $data["address"]) {
                $attributes = $addresses->firstOrFail(fn ($value, $index) => $index == $data["address"]);

                $data =  array_merge($data, array_merge($attributes, [
                    "longitude" => Arr::get($attributes, "x"),
                    "latitude" => Arr::get($attributes, "y"),
                    "is_verified" => true,
                ]));
            }

            $address = static::getModel()::make($data);
            $address->save();
            $address->therapists()->attach(filament()->auth()->user()->id);

            return $address;
        } else {
            $address = static::getModel()::create($data);

            $address->therapists()->attach(filament()->auth()->user()->id);

            return $address;
        }
    }
}
