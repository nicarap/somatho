<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Address;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AddressResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AddressResource\RelationManagers;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(fn ($record): string => $record ? $record->name : "Informations générales")->schema([
                    Forms\Components\Toggle::make("manual_address")
                        ->live()
                        ->formatStateUsing(fn ($record): bool => !is_null($record))
                        ->label(__("filament.attributes.manual_address")),
                    Forms\Components\Select::make('address')
                        ->visible(fn (Get $get) => !$get("manual_address"))
                        ->live()
                        ->searchable(fn ($record) => !($record))
                        ->options(fn ($record) => $record ? [$record->name] : [])
                        ->getSearchResultsUsing(function ($search): array {
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
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\TextInput::make("name")
                            ->label(__("filament.attributes.addresses.name"))
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make("street")
                                ->label(__("filament.attributes.addresses.street"))
                                ->required(),
                            Forms\Components\TextInput::make("context")
                                ->label(__("filament.attributes.addresses.context"))
                                ->required()
                        ]),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make("postcode")
                                ->label(__("filament.attributes.addresses.postcode"))
                                ->required(),
                            Forms\Components\TextInput::make("city")
                                ->label(__("filament.attributes.addresses.city"))
                                ->required(),
                        ]),
                    ])->visible(fn (Get $get) => $get("manual_address"))
                ])
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
            // 'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
