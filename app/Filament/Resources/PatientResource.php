<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\PatientResource\RelationManagers\TraitmentsRelationManager;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getBreadcrumb(): string
    {
        return __("filament.resources.user.label.plural");
    }

    public static function getModelLabel(): string
    {
        return __("filament.resources.user.label.single");
    }

    public static function getPluralModelLabel(): string
    {
        return __("filament.resources.user.label.plural");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->label(__("filament.attributes.name"))
                    ->required(),
                Forms\Components\DatePicker::make("birthdate")
                    ->label(__("filament.attributes.birthdate"))
                    ->required(),
                Forms\Components\TextInput::make("email")
                    ->label(__("filament.attributes.email"))
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make("tel")
                    ->label(__("filament.attributes.tel"))
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                Forms\Components\TextInput::make("siren")
                    ->label(__("filament.attributes.siren"))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label(__("filament.attributes.name"))
                    ->sortable(),
                Tables\Columns\TextColumn::make("birthdate")
                    ->label(__("filament.attributes.birthdate"))
                    ->formatStateUsing(fn ($state) => $state?->format("d/m/Y")),
                Tables\Columns\TextColumn::make("email")
                    ->label(__("filament.attributes.email")),
                Tables\Columns\TextColumn::make("traitments")
                    ->label(__("filament.attributes.traitments"))
                    ->state(fn ($record) => count($record->traitments))->badge()
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->withCount('traitments')
                            ->orderBy('traitments_count', $direction);
                    }),
                Tables\Columns\IconColumn::make("email_verified_at")
                    ->default(fn ($record): bool => !is_null($record->email_verified_at))
                    ->boolean()
                    ->label(__("filament.attributes.email_verified_at")),
                Tables\Columns\TextColumn::make("tel")
                    ->label(__("filament.attributes.tel")),
                Tables\Columns\TextColumn::make("siren")
                    ->label(__("filament.attributes.siren")),
            ])
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
            ])
            ->defaultSort('name', 'desc');;
    }

    public static function getRelations(): array
    {
        return [
            TraitmentsRelationManager::class,
            NotesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
