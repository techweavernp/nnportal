<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\ScheduleReport;
use App\Filament\Resources\Contracts\ContractResource;
use App\Filament\Resources\Equipment\EquipmentResource;
use App\Models\Contract;
use App\Models\Equipment;
use App\Models\Post;
use App\Models\PreventiveMaintenance;
use App\Models\Schedule;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            Stat::make('Post', Post::count())
                ->icon('heroicon-o-document-text')
                ->description('Total Posts')
                ->chart([1, 1, 1, 1, 1, 1, 1])
                ->color('success'),

        ];
    }
}
