<?php

namespace App\Filament\Pages;

use Filament\Forms;
use App\Models\Address;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Therapist;
use Filament\Infolists\Infolist;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class Profile extends Page implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profile';

    public function getTitle(): string|Htmlable
    {
        return __("filament.resources.profile.label.single");
    }

    public static function getNavigationLabel(): string
    {
        return __("filament.resources.profile.label.single");
    }

    public static function getNavigationIcon(): string
    {
        return "heroicon-o-calendar-days";
    }
    public Therapist $therapist;
    public ?array $data = [];

    public function mount()
    {
        $this->therapist = filament()->auth()->user();
        $this->form->fill($this->therapist->toArray());
    }

    public function editAddress()
    {
        redirect()->route("filament.admin.resources.addresses.edit", ["record" => $this->therapist->address]);
    }

    public function profileInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->therapist)
            ->schema([
                Infolists\Components\Section::make()
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 8,
                    ])->schema([
                        Infolists\Components\TextEntry::make("name")
                            ->label(__("filament.attributes.name")),
                        Infolists\Components\TextEntry::make("email")
                            ->label(__("filament.attributes.email"))
                    ]),
            ]);
    }

    public function submit()
    {
        Therapist::find(filament()->auth()->user()->id)->update($this->form->getState());

        Notification::make()
            ->title('Sauvegarde réussi')
            ->success()
            ->send();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make("name"),
            Forms\Components\TextInput::make("tel"),
            Forms\Components\TextInput::make("siren")
        ])->model(filament()->auth()->user())
            ->statePath('data');
    }
}
