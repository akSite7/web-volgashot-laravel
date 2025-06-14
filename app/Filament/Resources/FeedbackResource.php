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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;

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
                
                Section::make('Статус заявки')->schema([
                    ToggleButtons::make('status')
                        ->label('Статус')
                        ->inline()
                        ->default('new')
                        ->options([
                            'new' => 'Новая',
                            'processing' => 'В процессе',
                            'completed' => 'Выполнена',
                            'declined' => 'Отклонена',
                            'canceled' => 'Отменена',
                        ])
                        ->colors([
                            'new' => 'info',
                            'processing' => 'warning',
                            'completed' => 'success',
                            'declined' => 'danger',
                            'canceled' => 'danger',
                        ])
                        ->icons([
                            'new' => 'heroicon-m-sparkles',
                            'processing' => 'heroicon-m-arrow-path',
                            'completed' => 'heroicon-m-truck',
                            'declined' => 'heroicon-m-exclamation-circle',
                            'canceled' => 'heroicon-m-x-circle',
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Номер телефона')
                    ->searchable(),
                TextColumn::make('message')
                    ->label('Комментарий')
                    ->searchable(),
                SelectColumn::make('status')
                    ->label('Статус заявки')
                    ->options([
                            'new' => 'Новая',
                            'processing' => 'В процессе',
                            'completed' => 'Выполнена',
                            'declined' => 'Отклонена',
                            'canceled' => 'Отменена',
                        ])
                    ->rules(['required', 'in:new,processing,completed,declined,canceled']),
                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d/m/o H:i'),
            ])
            ->filters([
                //
            ])
            ->emptyStateHeading('Заявки не найдены')
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

    public static function getNavigationGroup(): ?string
    {
        return 'Обратная связь';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }
}
