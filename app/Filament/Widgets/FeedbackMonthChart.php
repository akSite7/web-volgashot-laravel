<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

use Carbon\Carbon;
class FeedbackMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Статистика';

    protected function getData(): array
    {
        $data = Trend::model(Feedback::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Заявки',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('m-d')),

        ];
    }

     public function getDescription(): ?string
    {
        return 'Количество поступивших заявок за месяц.';
    }

    protected function getType(): string
    {
        return 'line';
    }
}