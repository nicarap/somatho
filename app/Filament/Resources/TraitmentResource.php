<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Infolists;
use Filament\Forms\Form;
use App\Models\Traitment;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\TraitmentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TraitmentResource\RelationManagers;
use App\Filament\Resources\TraitmentResource\RelationManagers\NotesRelationManager;

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

    public static function form(Form $form): Form
    {
        $disabled = fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_start_at);

        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\Select::make('patient_id')
                        ->relationship("patient", "name")
                        ->reactive()
                        ->disabled($disabled)
                        ->required()
                        ->suffixAction(
                            Action::make('goToUser')
                                ->disabled(fn ($record) => is_null($record))
                                ->label("Voir l'utilisateur")
                                ->icon('heroicon-o-eye')
                                ->url(function ($state) {
                                    return $state ? route('filament.admin.resources.patients.edit', $state) : "#";
                                })
                        ),
                ]),
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\DateTimePicker::make('programmed_start_at')
                            ->seconds(false)
                            ->default(fn () => now())
                            ->minDate(now()->subYears(150))
                            ->live()
                            ->disabled($disabled)
                            ->required(),
                        Forms\Components\DateTimePicker::make('programmed_end_at')
                            ->seconds(false)
                            ->live()
                            ->minDate(fn (Get $get) => $get("programmed_start_at") ? Carbon::parse($get("programmed_start_at")) : now()->addHours())
                            ->default(fn () => now()->addHours())
                            ->maxDate(fn (Get $get) => Carbon::parse($get("programmed_start_at"))->endOfDay())
                            ->disabled($disabled)
                            ->required(),
                    ]),
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make("price")
                        ->numeric()
                        ->default(70)
                        ->disabled($disabled),
                    Forms\Components\Select::make('address_id')
                        ->relationship("address", "name")
                        ->options(function (Get $get) {
                            $addresses["Mes adresses"] = filament()->auth()->user()->addresses()->pluck("name", "addresses.id")->toArray();
                            if ($get("patient")) {
                                $patient = User::find($get("patient"));
                                if ($patient->address) $addresses[$patient->name] = [$patient->address->id => $patient->address->name];
                            }
                            return $addresses;
                        })->live()
                        ->disabled($disabled)
                        ->required(),
                ]),
                Forms\Components\RichEditor::make("note"),
                Forms\Components\Checkbox::make("realized_at")
                    ->label("Le soin à été réalisé")
                    ->disabled(fn ($record) => $record->isRealized())
                    ->visible(fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_end_at)),
            ])
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            InfoLists\Components\Section::make(fn ($record) => $record->patient->name)
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
                TextColumn::make("address.name")
                    ->label(__("filament.attributes.address")),
                TextColumn::make("price")
                    ->label(__("filament.attributes.price")),
                IconColumn::make("invoice")
                    ->boolean()
                    ->label(__("filament.attributes.invoice_sended")),
            ])
            ->striped()
            ->defaultSort("programmed_start_at", "desc")
            ->filters([
                \Filament\Tables\Filters\Filter::make("users")
                    ->form([
                        \Filament\Forms\Components\Select::make("users")
                            ->label(__("filament.attributes.patient"))
                            ->options(function () {
                                return User::whereHas("traitments")->pluck("name", "id");
                            })
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['users'],
                                fn (Builder $query, $patient): Builder => $query->whereRelation('patient', "id", $patient),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['users']) {
                            return null;
                        }

                        return 'Patient : ' . User::find($data['users'])->name;
                    }),
                \Filament\Tables\Filters\Filter::make("programmed_start_at")
                    ->form([
                        \Filament\Forms\Components\DatePicker::make("programmed_start_at")
                            ->label(__("filament.attributes.programmed_end_at"))
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['programmed_start_at'],
                                fn (Builder $query, $date): Builder => $query->whereDate('programmed_start_at', '>=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['programmed_start_at']) {
                            return null;
                        }

                        return 'Programmé le ' . Carbon::parse($data['programmed_start_at'])->format("j M Y");
                    })
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTraitments::route('/'),
            'create' => Pages\CreateTraitment::route('/create'),
            'edit' => Pages\EditTraitment::route('/{record}/edit'),
        ];
    }
}
