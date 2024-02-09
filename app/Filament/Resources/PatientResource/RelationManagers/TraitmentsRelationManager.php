<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Address;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TraitmentResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class TraitmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'traitments';

    public function form(Form $form): Form
    {
        $disabled = fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_start_at);

        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\DateTimePicker::make('programmed_start_at')
                            ->label(__("filament.attributes.programmed_start_at"))
                            ->minDate(fn () => !$disabled ? now()->format("Y-m-d H:i") : null)
                            ->default(fn () => now()->format("Y-m-d H:i"))
                            ->seconds(false)
                            ->live()
                            ->disabled($disabled)
                            ->required(),
                        Forms\Components\DateTimePicker::make('programmed_end_at')
                            ->label(__("filament.attributes.programmed_end_at"))
                            ->minDate(fn (Get $get) => $get("programmed_start_at") ? $get("programmed_start_at") : null)
                            ->maxDate(fn (Get $get) => Carbon::parse($get("programmed_start_at"))->endOfDay())
                            ->seconds(false)
                            ->live()
                            ->disabled($disabled)
                            ->required(),
                    ]),
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make("price")
                        ->label(__("filament.attributes.price"))
                        ->numeric()
                        ->default(70)
                        ->disabled($disabled),
                    Forms\Components\Select::make('address_id')
                        ->label(__("filament.attributes.address"))
                        ->relationship("address", "name")
                        ->options(function (Get $get, RelationManager $livewire) {
                            $addresses = filament()->auth()->user()->address()->get()->pluck("name", "id")->toArray();
                            if ($get("patient_id")) {
                                $patient = $livewire->getOwnerRecord();
                                if ($patient->address()->exists()) $addresses = array_merge($addresses, [$patient->address->id => $patient->address->name]);
                            }

                            return $addresses;
                        })
                        ->live()
                        ->disabled($disabled)
                        ->required(),
                ]),
                Forms\Components\RichEditor::make("note")
                    ->label(__("filament.attributes.note")),
                Forms\Components\Checkbox::make("realized_at")
                    ->label(__("filament.attributes.realized_at"))
                    ->label("Le soin à été réalisé")
                    ->disabled(fn ($record) => $record->isRealized())
                    ->visible(fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_end_at)),
            ])
        ]);
    }

    public function table(Table $table): Table
    {
        return TraitmentResource::table($table)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn ($record) => route("filament.admin.resources.traitments.edit", ["record" => $record])),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => $record->programmed_start_at > Carbon::now()),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $data['therapist_id'] = auth()->id();
                    $data['therapist_validated_at'] = Carbon::now();
                    $data['patient_validated_at'] = Carbon::now();

                    return $data;
                }),
            ]);
    }
}
