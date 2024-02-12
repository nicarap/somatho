<?php

namespace App\Filament\Resources\TraitmentResource\Pages;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\EditAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Actions\SendInvoiceAction;
use App\Filament\Resources\TraitmentResource;
use Illuminate\Support\Arr;

class EditTraitment extends EditRecord
{
    protected static string $resource = TraitmentResource::class;

    protected function getHeaderActions(): array
    {
        return $this->record->isRealized() ? [SendInvoiceAction::make()] : [];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (Arr::get($data, "realized_at") !== null) {
            if (intval($data["realized_at"]) === 1) {
                $data["realized_at"] = Carbon::now();
                $data["canceled_at"] = null;
            } else {
                $data["canceled_at"] = Carbon::now();
                $data["realized_at"] = null;
            }
        }

        $record->update($data);

        return $record;
    }
}
