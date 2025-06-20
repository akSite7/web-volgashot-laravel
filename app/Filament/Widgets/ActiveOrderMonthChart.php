<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

use Carbon\Carbon;
class ActiveOrderMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Статистика';
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Заказы',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('m-d')),

        ];
    }

     public function getDescription(): ?string
    {
        return 'Количество поступивших заказов за месяц.';
    }

    protected function getType(): string
    {
        return 'line';
    }
}