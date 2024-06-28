<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuários', User::query()->count())
                ->description('Usuários cadastrados')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->url('users'),
            Stat::make('Tarefas', Task::query()->count())
                ->description('Tarefas cadastradas')
                ->descriptionIcon('heroicon-o-presentation-chart-bar')
                ->color('primary')
            ->url('tasks'),
            Stat::make('Tarefas a fazer', Task::query()->where('status', '=', 'backlog')->count())
                ->description('Tarefas em backlog')
                ->descriptionIcon('heroicon-m-folder')
                ->color('primary')
            ->url('tasks'),
            Stat::make('Tarefas em desenvolvimento', Task::query()->where('status', '=', 'doing')->count())
                ->description('Tarefas em desenvolvimento')
                ->descriptionIcon('heroicon-m-command-line')
                ->color('primary')
                ->url('tasks'),
            Stat::make('Tarefas concluídas', Task::query()->where('status', '=', 'done')->count())
                ->description('Tarefas concluídas')
                ->descriptionIcon('heroicon-m-check')
                ->color('primary')
            ->url('tasks'),
        ];
    }
}
