<?php

namespace App\Filament\Resources\TraitmentResource\Pages;

use App\Filament\Resources\TraitmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTraitments extends ListRecords
{
    protected static string $resource = TraitmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
