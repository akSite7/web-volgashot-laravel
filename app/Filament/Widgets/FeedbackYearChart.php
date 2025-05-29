<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;


class FeedbackYearChart extends ChartWidget
{
    protected static ?string $heading = 'Статистика заявок';

    protected function getData(): array
    {
        $data = Trend::model(Feedback::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Заявки',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        ];
    }

    public function getDescription(): ?string
    {
        return 'Количество поступивших заявок за год.';
    }

    protected function getType(): string
    {
        return 'line';
    }
}