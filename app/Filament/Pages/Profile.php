<?php

namespace App\Filament\Pages;

use App\Models\Address;
use Filament\Forms;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Infolists\Infolist;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class Profile extends Page implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];

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
    public $therapist;

    public function mount()
    {
        $this->therapist = filament()->auth()->user();
    }

    public function markAsDefault(Address $address)
    {
        // TODO : Mouve to livewire component Previews ?
        foreach ($this->therapist->addresses as $therapist_address) {
            $this->therapist->addresses()->updateExistingPivot($therapist_address->id, ["default" => false]);
        }

        $this->therapist->addresses()->updateExistingPivot($address->id, ["default" => true]);
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
                Infolists\Components\RepeatableEntry::make('addresses')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label(__("filament.attributes.addresses.name")),
                        Infolists\Components\TextEntry::make('default')
                            ->label(__("filament.attributes.addresses.default")),
                        Infolists\Components\TextEntry::make('street')
                            ->label(__("filament.attributes.addresses.street")),
                        Infolists\Components\TextEntry::make('context')
                            ->label(__("filament.attributes.addresses.context")),
                        Infolists\Components\TextEntry::make('postcode')
                            ->label(__("filament.attributes.addresses.postcode")),
                        Infolists\Components\TextEntry::make('city')
                            ->label(__("filament.attributes.addresses.city")),
                    ])
                    ->columns(2)
            ]);
    }
}
