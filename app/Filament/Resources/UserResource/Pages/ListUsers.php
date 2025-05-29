<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->successNotification(
                Notification::make()
                    ->success()
                    ->icon('heroicon-o-user-plus')
                    ->title('Уведомление')
                    ->body('Пользователь был успешно создан!')
            ),
        ];
    }
}