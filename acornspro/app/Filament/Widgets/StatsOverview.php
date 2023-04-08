<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\HtmlString;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $workordersLastWeek = \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(14), \Carbon\Carbon::now()->subdays(7)])->count();
        $workordersThisWeek = \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(7), \Carbon\Carbon::now()])->count();
        $openWorkorders = (($workordersThisWeek - $workordersLastWeek) / max($workordersLastWeek, 1)) * 100;
        $openWorkordersIcon = $openWorkorders > 0 ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down';
        $openWorkordersColor = $openWorkorders > 0 ? 'success' : 'danger';

        return [
            Card::make('Open Workorders', new HtmlString('<a href="'.route('filament.resources.workorders.index').'">'.\App\Models\Workorder::where('status', 'Open')->count().'</a>'))
                ->description(number_format($openWorkorders, 2).'%')
                ->descriptionIcon($openWorkordersIcon)
                ->color($openWorkordersColor)
                ->chart([
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(7), \Carbon\Carbon::now()->subdays(6)])->count(),
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(6), \Carbon\Carbon::now()->subdays(5)])->count(),
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(5), \Carbon\Carbon::now()->subdays(4)])->count(),
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(4), \Carbon\Carbon::now()->subdays(3)])->count(),
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(3), \Carbon\Carbon::now()->subdays(2)])->count(),
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(2), \Carbon\Carbon::now()->subdays(1)])->count(),
                    \App\Models\Workorder::whereBetween('created_at', [\Carbon\Carbon::now()->subdays(1), \Carbon\Carbon::now()])->count(),
                ]),
        ];
    }
}
