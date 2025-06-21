<?php

namespace App\Filament\Resources;

use App\Models\Contact;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\ContactResource\Pages;
// Добавленные use
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Информация';
    protected static ?string $navigationLabel = 'Контактная информация';
    protected static ?string $modelLabel = 'Контакты';
    protected static ?string $pluralModelLabel = 'Контакты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основные данные')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Полное название организации')
                            ->placeholder('Полное название')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('name')
                            ->label('Название организации')
                            ->placeholder('Название организации')
                            ->maxLength(255)
                            ->required(),  
                    ]),
                    Repeater::make('spec')
                        ->label('Список информации')
                        ->schema([
                            TextInput::make('name')
                                ->label('Название')
                                ->placeholder('Название')
                                ->required(),
                            TextInput::make('value')
                                ->label('Значение')
                                ->placeholder('Значение')
                                ->required(),
                        ])->columns(2),
                    Section::make('Отображение контактной информации')->schema([
                        Toggle::make('is_active')
                            ->label('Отключена / Включена')
                            ->default(true)
                            ->required(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // Сортировка по последним созданным записям
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->label('Полное название')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Название организации')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Отображение'),
            ])
            ->filters([
                //
            ])
            // Сообщение при отсутствии контактных данных
            ->emptyStateHeading('Контакты не найдены')
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Уведомление')
                            ->icon('heroicon-o-trash')
                            ->iconColor('danger')
                            ->body('Контактная информация была успешно удалена!')
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
                            ->body('Контактная информация была успешно удалена!')
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    // Сортировка положения в меню
    public static function getNavigationSort(): ?int
    {
        return 5;
    }
}
