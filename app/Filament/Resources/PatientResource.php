<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Component;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\PatientResource\RelationManagers\TraitmentsRelationManager;

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
                Section::make("Informations générales")->schema([
                    Forms\Components\TextInput::make("name")
                        ->label(__("filament.attributes.name"))
                        ->required(),
                    Forms\Components\TextInput::make("email")
                        ->label(__("filament.attributes.email"))
                        ->email()
                        ->required(),
                    Forms\Components\TextInput::make("tel")
                        ->label(__("filament.attributes.tel"))
                        ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                    Forms\Components\DatePicker::make("birthdate")
                        ->label(__("filament.attributes.birthdate"))
                        ->required(),
                    Forms\Components\Toggle::make("manual_address")
                        ->live()
                        ->default(false)
                        ->label(__("filament.attributes.manual_address")),
                    Forms\Components\Select::make('address')
                        ->visible(fn (Get $get) => !$get("manual_address"))
                        ->live()
                        ->searchable(fn ($record) => !($record && $record->address()->exists()))
                        ->options(fn ($record) => ($record && $record->address()->exists()) ? [$record->address->name] : [])
                        ->getSearchResultsUsing(function ($search, Request $request): array {
                            if (!$search || $search === "" || strlen($search) <= 3 || strlen($search) >= 200)
                                return [];

                            session(["addresses" => []]);

                            $response = Http::retry(3, 100)->withQueryParameters([
                                'q' => $search,
                            ])->get('https://api-adresse.data.gouv.fr/search');

                            $addresses = [];
                            $session_addresses = [];

                            foreach (Arr::get($response->json(), "features") as $index => $feature) {
                                $properties = Arr::get($feature, "properties");

                                $addresses[$index] =
                                    Arr::get($properties, "name") . ", " .
                                    Arr::get($properties, "context") . ", " .
                                    Arr::get($properties, "city");

                                $session_addresses[] = $properties;
                            }

                            session(["addresses" => $session_addresses]);

                            return $addresses;
                        }),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make("address_name")
                            ->label(__("filament.attributes.addresses.name"))
                            ->live(),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make("address_street")
                                ->label(__("filament.attributes.addresses.street"))
                                ->live(),
                            Forms\Components\TextInput::make("address_context")
                                ->label(__("filament.attributes.addresses.context"))
                                ->live()
                        ]),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make("address_postcode")
                                ->label(__("filament.attributes.addresses.postcode"))
                                ->live(),
                            Forms\Components\TextInput::make("address_city")
                                ->label(__("filament.attributes.addresses.city"))
                                ->live(),
                        ]),
                    ])->visible(fn (Get $get) => $get("manual_address"))
                ])
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
                Tables\Columns\TextColumn::make("address.name")
                    ->label(__("filament.attributes.address")),
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
