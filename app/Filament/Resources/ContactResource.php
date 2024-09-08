<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

    public static function getNavigationBadge(): null|string
    {
        return Contact::whereNull('read_at')->count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make("name")
                        ->required()
                        ->label(__("filament.attributes.name")),
                    Grid::make()->schema([
                        TextInput::make("email")
                            ->required()
                            ->label(__("filament.attributes.email")),
                        TextInput::make("tel")
                            ->required()
                            ->label(__("filament.attributes.tel"))
                    ]),
                ]),
                Section::make()->schema([
                    Textarea::make("message")
                        ->required()
                        ->label(__("filament.attributes.content")),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        $columns = [
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
        ];
        foreach ($columns as $value) {
            $value->action(function (Contact $record): void {
                if (!$record->isReaded()) {
                    $record->update([
                        'read_at' => Carbon::now()
                    ]);
                }
                redirect()->route('filament.admin.resources.contacts.view', $record);
            });
        }

        return $table
            ->columns($columns)
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
            'view' => Pages\ViewContacts::route('/{record}')
        ];
    }
}
