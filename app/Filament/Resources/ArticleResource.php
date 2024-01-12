<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use GuzzleHttp\Client;
use App\Models\Article;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make("gtp")
                        ->label(__("filament.attributes.gtp"))
                        ->autocomplete()
                        ->suffixAction(
                            Action::make('copyCostToPrice')
                                ->icon('heroicon-m-clipboard')
                                ->action(function (Set $set, $state) {
                                    $client = new Client();

                                    $response = $client->post(config('api.chatgpt.endpoint'), [
                                        'headers' => [
                                            'Authorization' => 'Bearer ' . config('api.chatgpt.api_key'),
                                            'Content-Type' => 'application/json',
                                        ],
                                        'json' => [
                                            "messages" => [["role" => "user", "content" => $state]],
                                            "model" => config('api.chatgpt.model'),
                                        ],
                                    ]);

                                    $set("content", Arr::get(json_decode($response->getBody(), true), "choices.0.message.content"));
                                })
                        ),
                    Forms\Components\TextInput::make("title")
                        ->label(__("filament.attributes.title"))
                        ->required(),
                    Forms\Components\RichEditor::make("content")
                        ->label(__("filament.attributes.content"))
                        ->required(),
                    Forms\Components\FileUpload::make('image'),
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Toggle::make("is_pinned")
                            ->label(__("filament.attributes.pinned")),
                        Forms\Components\DatePicker::make("published_at")
                            ->label(__("filament.attributes.published_at"))
                            ->required(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("title"),
                Tables\Columns\TextColumn::make("content")->html()->limit(50),
                Tables\Columns\ToggleColumn::make("is_pinned"),
                Tables\Columns\TextColumn::make("published_at")->date(),
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
            'index' => Pages\ListArticle::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
