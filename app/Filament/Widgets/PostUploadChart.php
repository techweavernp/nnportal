<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PostUploadChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Post Chart';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $posts = Post::query()
            ->selectRaw('MONTH(published_at) as month, COUNT(*) as count')
            ->whereYear('published_at', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = [];
        $counts = [];

        for ($month = 1; $month <= 12; $month++) {
            $months[] = Carbon::create()->month($month)->format('M');
            $counts[] = $posts[$month] ?? 0;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Posts created',
                    'data' => $counts,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
