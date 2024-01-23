<?php

namespace App\Filament\Resources\TraitmentResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Actions\SendInvoiceAction;
use App\Filament\Resources\TraitmentResource;

class EditTraitment extends EditRecord
{
    protected static string $resource = TraitmentResource::class;

    protected function getHeaderActions(): array
    {
        return $this->record->isRealized() ? [SendInvoiceAction::make()] : [];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data["realized_at"] == 1) $data["realized_at"] = Carbon::now();
        $record->update($data);

        return $record;
    }
}
