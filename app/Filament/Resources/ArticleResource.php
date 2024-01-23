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
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ArticleResource\RelationManagers;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationGroup = 'CRM';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make("gtp")
                        ->label(__("filament.attributes.gtp"))
                        ->autocomplete()
                        ->suffixAction(
                            Action::make('generateGPT')
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
                    Forms\Components\FileUpload::make('image')->required(),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\Select::make("tags")
                            ->relationship("tags", "name")->preload()->searchable()->multiple()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\ColorPicker::make('color')
                                    ->required(),
                            ])
                            ->label(__("filament.attributes.tags")),
                        Forms\Components\Toggle::make("is_pinned")
                            ->label(__("filament.attributes.pinned")),
                        Forms\Components\DatePicker::make("published_at")
                            ->default(fn () => Carbon::now())
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
                Tables\Columns\TextColumn::make("title")
                    ->label(__("filament.attributes.title")),
                Tables\Columns\TextColumn::make("content")->html()->limit(50)
                    ->label(__("filament.attributes.content")),
                Tables\Columns\ViewColumn::make("tags")->view('tables.columns.tags')
                    ->label(__("filament.attributes.tags")),
                Tables\Columns\ToggleColumn::make("is_pinned")
                    ->label(__("filament.attributes.pinned")),
                Tables\Columns\TextColumn::make("published_at")->date()
                    ->label(__("filament.attributes.published_at")),
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
