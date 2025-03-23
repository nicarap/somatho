<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Tables;
use Filament\Forms;
use App\Models\Invoice;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\InvoiceResource\Pages;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function getBreadcrumb(): string
    {
        return __("filament.resources.invoice.label.plural");
    }

    public static function getModelLabel(): string
    {
        return __("filament.resources.invoice.label.single");
    }

    public static function getPluralModelLabel(): string
    {
        return __("filament.resources.invoice.label.plural");
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn() => Invoice::query()->orderBy('created_at', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make("number")
                    ->label(__("filament.attributes.invoice_number")),
                Tables\Columns\TextColumn::make("patient.name")
                    ->label(__("filament.attributes.patient")),
                Tables\Columns\TextColumn::make("created_at")
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->format("d/m/Y H:i"))
                    ->label(__("filament.attributes.created_at")),
                Tables\Columns\ToggleColumn::make("paid_at")
                    ->disabled()
                    ->tooltip(fn($state) => $state ? Carbon::parse($state)->format("d/m/Y") : 'N\'a pas encore été payé')
                    ->label(__("filament.attributes.paid_at")),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make("Payer")
                    ->form([
                        Forms\Components\DatePicker::make('paid_at')
                            ->label('Date de paiement')
                            ->maxDate(Carbon::now())
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'paid_at' => $data['paid_at'],
                        ]);
                        foreach ($record->traitments as $traitment) {
                            $traitment->update([
                                'paid_at' => $data['paid_at'],
                            ]);
                        }
                    })
                    ->hidden(fn($record) => $record->paid_at !== null)
                    ->successNotification(fn() => "La date de paiement a été mise à jour avec succès"),
                Tables\Actions\Action::make("Voir")
                    ->url(fn($record) => route("invoice", ["invoice" => $record]))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
        ];
    }
}
