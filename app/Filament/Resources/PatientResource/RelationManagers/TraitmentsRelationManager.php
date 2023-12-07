<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Models\Address;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TraitmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'traitments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('programmed_start_at')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('d/m/Y') : null),
                Tables\Columns\TextColumn::make('programmed_end_at')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('d/m/Y') : null),
                Tables\Columns\TextColumn::make('address.label'),
                Tables\Columns\ToggleColumn::make('therapist_validated_at'),
                Tables\Columns\ToggleColumn::make('patient_validated_at'),
                Tables\Columns\TextColumn::make('realized_at'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('travel_cost'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn ($record) => route('filament.admin.resources.traitments.view', $record)),
            ])
            ->bulkActions([
                //
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
