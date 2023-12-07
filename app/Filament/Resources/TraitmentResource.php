<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Infolists;
use Filament\Forms\Form;
use App\Models\Traitment;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TraitmentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TraitmentResource\RelationManagers;
use App\Filament\Resources\TraitmentResource\RelationManagers\NotesRelationManager;
use Carbon\Carbon;

class TraitmentResource extends Resource
{
    protected static ?string $model = Traitment::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function getBreadcrumb(): string
    {
        return __("filament.resources.traitment.label.plural");
    }

    public static function getModelLabel(): string
    {
        return __("filament.resources.traitment.label.single");
    }

    public static function getPluralModelLabel(): string
    {
        return __("filament.resources.traitment.label.plural");
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            InfoLists\Components\Section::make("aze")
                ->schema([
                    InfoLists\Components\Grid::make()->schema([
                        InfoLists\Components\TextEntry::make("patient.name"),
                    ])
                ])->compact()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("patient.name")
                    ->label(__("filament.attributes.patient")),
                TextColumn::make("programmed_start_at")
                    ->label(__("filament.attributes.programmed_start_at"))
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format("d/m/Y h:i")),
                TextColumn::make("programmed_end_at")
                    ->label(__("filament.attributes.programmed_end_at"))
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format("d/m/Y h:i")),
                TextColumn::make("address.label")
                    ->label(__("filament.attributes.address")),
                TextColumn::make("price")
                    ->label(__("filament.attributes.price")),
                TextColumn::make("discount")
                    ->label(__("filament.attributes.discount")),
                IconColumn::make("therapist_validated_at")
                    ->default(fn ($record): bool => !is_null($record->therapist_validated_at))
                    ->boolean()
                    ->label(__("filament.attributes.therapist_validated_at")),
                IconColumn::make("patient_validated_at")
                    ->boolean()
                    ->default(fn ($record): bool => !is_null($record->patient_validated_at))
                    ->label(__("filament.attributes.patient_validated_at")),
            ])
            ->striped()
            ->defaultSort("programmed_start_at", "desc")
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            NotesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTraitments::route('/'),
            'create' => Pages\CreateTraitment::route('/create'),
            'edit' => Pages\EditTraitment::route('/{record}/edit'),
            'view' => Pages\ViewTraitment::route('/{record}'),
        ];
    }
}
