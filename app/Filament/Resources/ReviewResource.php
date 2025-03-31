<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Review;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\ReviewResource\Pages;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationGroup = 'CRM';
    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function getBreadcrumb(): string
    {
        return __("filament.resources.review.label.plural");
    }

    public static function getModelLabel(): string
    {
        return __("filament.resources.review.label.single");
    }

    public static function getPluralModelLabel(): string
    {
        return __("filament.resources.review.label.plural");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make("name")
                        ->required()
                        ->label(__("filament.attributes.name")),
                    TextInput::make("firstname")
                        ->required()
                        ->label(__("filament.attributes.firstname")),
                    TextInput::make("subject")
                        ->required()
                        ->label(__("filament.attributes.subject")),
                    Textarea::make("content")
                        ->required()
                        ->label(__("filament.attributes.content")),
                    TextInput::make("value")
                        ->required()
                        ->numeric()
                        ->inputMode('decimal')
                        ->label(__("filament.attributes.value")),
                    TextInput::make("location")
                        ->required()
                        ->label(__("filament.attributes.location")),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label(__("filament.attributes.name")),
                TextColumn::make("content")->limit("50")
                    ->label(__("filament.attributes.content")),
                ViewColumn::make('value')->view('tables.columns.reviews')
                    ->label(__("filament.attributes.value")),
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
            ]);
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
