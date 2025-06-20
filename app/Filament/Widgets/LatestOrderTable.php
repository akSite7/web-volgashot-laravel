<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;

class LatestOrderTable extends BaseWidget
{
    protected static ?string $heading = 'Последние заказы';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('first_name')
                    ->label('Имя'),
                TextColumn::make('phone')
                    ->label('Номер телефона'),
                TextColumn::make('city')
                    ->label('Город'),
                TextColumn::make('city')
                    ->label('Сумма заказа'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'completed' => 'success',
                        'declined' => 'danger',
                        'canceled' => 'danger',
                    })
                    ->icons([
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'completed' => 'heroicon-m-truck',
                        'declined' => 'heroicon-m-exclamation-circle',
                        'canceled' => 'heroicon-m-x-circle',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => 'Новая',
                        'processing' => 'В процессе',
                        'completed' => 'Выполнена',
                        'declined' => 'Отклонена',
                        'canceled' => 'Отменена',
                        default => ucfirst($state),
                    })
                    ->label('Статус заявки'),
                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d/m/o H:i'),

            ])
            ->emptyStateHeading('Заявки не найдены')
            ->actions([
                Action::make('Просмотр')                    
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->url(fn (Order $record): string => OrderResource::getUrl('index', ['record' => $record])),
                DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Уведомление')
                        ->body('Заявка была успешно удалена!')
                ),
            ]);
    }
}
