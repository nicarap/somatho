<?php

namespace App\Filament\Resources\TraitmentResource\Pages;

use App\Filament\Actions\SendInvoiceAction;
use App\Filament\Resources\TraitmentResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\EditRecord;

class EditTraitment extends EditRecord
{
    protected static string $resource = TraitmentResource::class;

    protected function getHeaderActions(): array
    {

        return Carbon::now() > $this->record->programmed_end_at ? [SendInvoiceAction::make()] : [];
    }
}
