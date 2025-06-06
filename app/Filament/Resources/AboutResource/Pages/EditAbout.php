<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditAbout extends EditRecord
{
    protected static string $resource = AboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Уведомление')
                        ->icon('heroicon-o-trash')
                        ->iconColor('danger')
                        ->body('Информация была успешно удалена!')
                ),
        ];
    }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification {
        return Notification::make()
            ->success()
            ->title('Уведомление')
            ->icon('heroicon-o-pencil-square')
            ->body('Информация была успешно изменена!');
    }
}
