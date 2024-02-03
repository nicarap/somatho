<?php

namespace App\Filament\Resources\TraitmentResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TraitmentResource;
use Carbon\Carbon;
use Filament\Facades\Filament;

class CreateTraitment extends CreateRecord
{
    protected static string $resource = TraitmentResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data["therapist_id"] = filament()->auth()->user()->id;
        $data["therapist_validated_at"] = Carbon::now();
        $data["patient_validated_at"] = Carbon::now();

        return static::getModel()::create($data);
    }
}
