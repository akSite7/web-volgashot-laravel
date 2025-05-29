<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;
    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-down-left';
    protected static ?string $navigationLabel = 'Заявки';
    protected static ?string $modelLabel = 'Заявки';
    protected static ?string $pluralModelLabel = 'Заявки';
    protected static ?string $navigationGroup = 'Обратная связь';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основные данные')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Имя')
                            ->placeholder('Имя')
                            ->required(),
                        TextInput::make('phone')
                            ->label('Номер телефона')
                            ->suffixIcon('heroicon-o-phone')
                            ->tel()
                            ->mask('+7 (999)-999-99-99')
                            ->regex('/^\+7\s?\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/')
                            ->placeholder('Номер телефона')
                            ->required(),  
                    ]),
                    TextArea::make('message')
                            ->label('Комментарий')
                            ->autosize()
                            ->placeholder('Комментарий')
                            ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Номер телефона')
                    ->searchable(),
                TextColumn::make('message')
                    ->label('Комментарий')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d/m/o H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Уведомление')
                            ->icon('heroicon-o-trash')
                            ->iconColor('danger')
                            ->body('Заявка была успешно удалена!')
                    ),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Уведомление')
                            ->icon('heroicon-o-trash')
                            ->iconColor('danger')
                            ->body('Заявка была успешно удалена!')
                    ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }

    // Убирает кнопку создать
    public static function canCreate(): bool
    {
        return false;
    }

    // Добавляет счетчик количества заявок
    public static function getNavigationBadge(): ?string 
    {
        return static::getModel()::count();
    }
}
