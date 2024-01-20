<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;
use App\Services\UserService;

class CreatePatient extends CreateRecord
{
    protected static string $resource = PatientResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data["password"] = UserService::generateRandomPassword();

        return static::getModel()::create($data);
    }
}
