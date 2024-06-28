<?php

namespace App\Filament\Resources\TaskResource\Widgets;

use App\Models\Task;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tasks')
                ->value(Task::count())
                ->icon('heroicon-o-clipboard-list'),
            Stat::make('Total Users')
                ->value(User::count())
                ->icon('heroicon-o-users'),
        ];
    }
}
