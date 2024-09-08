<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewContacts extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Créer la fiche patient')
                ->action(function (Contact $record) {
                    redirect()->route('filament.admin.resources.patients.create', [
                        'name' => $record->name,
                        'email' => $record->email,
                        'tel' => $record->tel,
                        'note' => $record->message,
                    ]);
                })
        ];
    }
}
