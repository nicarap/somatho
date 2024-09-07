<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getBreadcrumb(): string
    {
        return __("filament.resources.contact.label.plural");
    }

    public static function getModelLabel(): string
    {
        return __("filament.resources.contact.label.single");
    }

    public static function getPluralModelLabel(): string
    {
        return __("filament.resources.contact.label.plural");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->label(__("filament.attributes.name")),
                Tables\Columns\TextColumn::make("email")
                    ->label(__("filament.attributes.email")),
                Tables\Columns\TextColumn::make("tel")
                    ->label(__("filament.attributes.tel")),
                Tables\Columns\TextColumn::make("created_at")
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format("d/m/Y H:i"))
                    ->label(__("filament.attributes.created_at")),
                Tables\Columns\TextColumn::make("created_at")
                    ->badge(fn ($record) => !$record->isReaded())
                    ->formatStateUsing(function ($record): string {
                        if ($record->isReaded()) {
                            return Carbon::parse($record->read_at)->format("d/m/Y H:i");
                        } else {
                            return  'NEW';
                        }
                    })
                    ->label(__("filament.attributes.read_at")),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
        ];
    }
}
