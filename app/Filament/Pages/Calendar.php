<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Widgets\CalendarWidget;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Calendar extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.calendar';

    public function getTitle(): string | Htmlable
    {
        return __("filament.resources.calendar.label.single");
    }

    public static function getNavigationLabel(): string
    {
        return __("filament.resources.calendar.label.single");
    }

    public static function getNavigationIcon(): string
    {
        return "heroicon-o-calendar-days";
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CalendarWidget::class,
        ];
    }
}
