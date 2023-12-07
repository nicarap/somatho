<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::now();
        $start_of_week = $today->copy()->startOfWeek();
        $end_of_week = $today->copy()->endOfWeek();

        return [
            Stat::make('traitments for the week', function () use ($start_of_week, $end_of_week) {
                return filament()->auth()->user()->traitments()->startAt($start_of_week)->endAt($end_of_week)->count();
            })
            ->description($start_of_week->format('d/m/Y') . ' to ' . $end_of_week->format('d/m/Y')),

            Stat::make('traitments for the day', function () use ($today) {
                return filament()->auth()->user()->traitments()->startAt($today->startOfDay())->endAt($today->endOfDay())->count();
            })->description($today->format('d/m/Y')),
        ];
    }
}
