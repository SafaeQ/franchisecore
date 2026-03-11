<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends StatsOverviewWidget
{
    /**
     * @return array<int, Stat>
     */
    protected function getStats(): array
    {
        $total = User::query()->count();
        $active = User::query()->where('is_active', true)->count();
        $inactive = User::query()->where('is_active', false)->count();

        return [
            Stat::make('Total users', $total),
            Stat::make('Active users', $active),
            Stat::make('Inactive users', $inactive),
        ];
    }
}
