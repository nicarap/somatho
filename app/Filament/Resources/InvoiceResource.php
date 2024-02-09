<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Tables;
use App\models\Invoice;
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
            ->columns([
                Tables\Columns\TextColumn::make("number")
                    ->label(__("filament.attributes.invoice_number")),
                Tables\Columns\TextColumn::make("traitment.patient.name")
                    ->label(__("filament.attributes.patient")),
                Tables\Columns\TextColumn::make("traitment.programmed_start_at")
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format("d/m/Y H:i"))
                    ->label(__("filament.attributes.traitment")),
                Tables\Columns\TextColumn::make("paid_at")
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format("d/m/Y H:i"))
                    ->label(__("filament.attributes.paid_at")),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make("Voir")
                    ->url(fn ($record) => route("invoice", ["invoice" => $record]))
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
