<?php

namespace App\Filament\Pages\Widgets;

use Exeption;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Forms\Get;
use App\Models\Traitment;
use Illuminate\Support\Arr;
use App\Services\TraitmentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Actions;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Widgets\Concerns\InteractsWithEvents;

class CalendarWidget extends FullCalendarWidget
{
    use InteractsWithEvents;

    public Model | string | null $model = Traitment::class;

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
                    "notes" => [
                        ["description" => "test"]
                    ]
                ]
            )
            ->all();
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make()
                ->using(function (array $data, TraitmentService $traitmentService) {
                    dd($data);
                }),
            Actions\DeleteAction::make(),
        ];
    }

    public function getFormSchema(): array
    {
        $disabled = fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_start_at);

        return [
            Forms\Components\Select::make('patient')
                ->relationship("patient", "name")
                ->reactive()
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\Section::make("Informations générales")->schema([
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
                    ])
                ])
                ->disabled($disabled)
                ->required(),
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('programmed_start_at')
                        ->seconds(false)
                        ->default(fn () => now())
                        ->minDate(now()->subYears(150))
                        ->live()
                        ->hoursStep(2)
                        ->minutesStep(15)
                        ->disabled($disabled)
                        ->required(),
                    Forms\Components\DateTimePicker::make('programmed_end_at')
                        ->seconds(false)
                        ->live()
                        ->minDate(fn (Get $get) => Carbon::parse($get("programmed_start_at")))
                        ->maxDate(fn (Get $get) => Carbon::parse($get("programmed_start_at"))->endOfDay())
                        ->hoursStep(2)
                        ->minutesStep(15)
                        ->disabled($disabled)
                        ->required(),
                ]),

            Forms\Components\Select::make('address')
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
            // Forms\Components\Repeater::make("notes")
            //     ->relationship()
            //     ->disabled($disabled)
            //     ->schema(fn ($record): array => $record ? [
            //         Forms\Components\MarkdownEditor::make("description")
            //     ] : [
            //         Forms\Components\RichEditor::make("description")
            //     ])
            //     ->reorderableWithDragAndDrop(false),
            Forms\Components\Checkbox::make("realized_at")
                ->label("Le soin à été réalisé")
                ->visible(fn ($record) => $record && Carbon::now() > Carbon::parse($record->programmed_end_at)),
            // Forms\Components\ViewField::make('rating')
            //     ->view('forms.components.leaflet')

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
                            'price' => 70,
                            'therapist_id' => filament()->auth()->user(),
                            'patient_id' => $data["patient"],
                            'address_id' => $data["address"]
                        ]));

                        $traitment->save();

                        if ($notes = Arr::get($data, "notes")) {
                            foreach ($notes as $note) {
                                $traitmentService->addNote($traitment, $note);
                            }
                        }

                        $traitmentService->therapistValidation($traitment, Carbon::now());
                        $traitmentService->patientValidation($traitment, Carbon::now());

                        Db::commit();
                    } catch (\Exception $e) {
                        dd($e);
                        Db::rollback();
                    }
                })
                ->mountUsing(
                    function (Forms\Form $form, array $arguments) {
                        $form->fill([
                            'programmed_start_at' => $arguments['start'] ?? null,
                            'programmed_end_at' => $arguments['end'] ?? null
                        ]);
                    }
                )
        ];
    }
}
