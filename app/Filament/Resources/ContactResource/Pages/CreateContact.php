<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification {
        return Notification::make()
            ->success()
            ->title('Уведомление')
            ->body('Новая контактная информация была успешно создана!');
    }
}
