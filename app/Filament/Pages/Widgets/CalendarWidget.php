<?php

namespace App\Filament\Pages\Widgets;

use Exeption;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Get;
use App\Models\Traitment;
use Illuminate\Support\Arr;
use App\Services\UserService;
use App\Services\TraitmentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Actions;
use App\DataTransferObjects\traitmentDTO;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Widgets\Concerns\InteractsWithEvents;

class CalendarWidget extends FullCalendarWidget
{
    use InteractsWithEvents;

    public Model|string|null $model = Traitment::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Traitment::query()
            ->where("programmed_start_at", ">=", $fetchInfo['start'])
            ->where("programmed_end_at", ">=", $fetchInfo['start'])
            ->get()
            ->map(
                fn (Traitment $traitment) => [
                    'id' => $traitment->id,
                    'title' => $traitment->patient->name,
                    'start' => $traitment->programmed_start_at,
                    'end' => $traitment->programmed_end_at,
                    "note" => $traitment->note,
                ]
            )
            ->all();
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make()
                ->disabled(fn ($record) => $record->isRealized())
                ->mutateFormDataUsing(function (array $data): array {
                    if (intVal(Arr::get($data, 'realized_at',))) {
                        $data['realized_at'] = Carbon::now();
                    } else {
                        $data['realized_at'] = null;
                        $data['canceled_at'] = Carbon::now();
                    }

                    return $data;
                }),
            Actions\DeleteAction::make()
                ->label("Annuler le soin")
                ->visible(fn ($record) => $record->programmed_start_at > Carbon::now())
        ];
    }

    public function getFormSchema(): array
    {
        $disabled = fn ($record) => $record && (Carbon::now() > Carbon::parse($record->programmed_start_at) || $record->isCanceled());

        return [
            Forms\Components\Section::make()->schema([
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\Select::make('patient_id')
                        ->label(__("filament.attributes.patient"))
                        ->relationship("patient", "name")
                        ->live()
                        ->disabled($disabled)
                        ->required()
                        ->suffixAction(
                            Action::make('goToUser')
                                ->disabled(fn ($state) => is_null($state))
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
                        ->options(function (Get $get) {
                            $addresses = filament()->auth()->user()->address()->get()->pluck("name", "id")->toArray();
                            if ($get("patient_id")) {
                                $patient = User::find($get("patient_id"));
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
                Forms\Components\Radio::make("realized_at")
                    ->label(__("filament.attributes.realized_at"))
                    ->label("Le soin à été réalisé")
                    ->options([true => "Oui", false => "Non"])
                    ->formatStateUsing(function ($record): bool|null {
                        if ($record) {
                            return $record->isCanceled() ? false : ($record->isRealized() ? true : null);
                        }
                        return null;
                    })
                    ->disabled(fn ($record) => $record->isRealized() ||  $record->isCanceled())
                    ->visible(fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_end_at)),
            ])
        ];
    }

    protected function headerActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data, TraitmentService $traitmentService) {
                    DB::beginTransaction();

                    try {
                        $traitment = $traitmentService->create(array_merge($data, [
                            'therapist_id' => filament()->auth()->user(),
                        ]));

                        $traitment->save();

                        $traitmentService->therapistValidation($traitment, Carbon::now());
                        $traitmentService->patientValidation($traitment, Carbon::now());

                        Db::commit();
                    } catch (\Exception $e) {
                        Db::rollback();
                    }
                })
        ];
    }
}
