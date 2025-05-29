<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

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
                        ->body('Контактная информация была успешно удалена!')
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
            ->body('Контактная информация была успешно изменена!');
    }
}
