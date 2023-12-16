<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    // protected static string $view = "filament.pages.patients.list";

    public function getPatients()
    {
        return User::all();
    }

    public function showPatient(User $patient)
    {
        dd($patient);
        return redirect(route('filament.admin.resources.patients.edit', ["record" => $patient]));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
