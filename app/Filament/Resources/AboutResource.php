<?php

namespace App\Filament\Resources;

use App\Models\About;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\AboutResource\Pages;
// Добавленные use
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Информация';
    protected static ?string $navigationLabel = 'Дополнительная информация';
    protected static ?string $modelLabel = 'Информация';
    protected static ?string $pluralModelLabel = 'Информация';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основные данные')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Оглавление')
                            ->placeholder('Оглавление')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('name')
                            ->label('Описание')
                            ->maxLength(255)
                            ->placeholder('Описание')
                            ->required(),  
                    ]),
                    Repeater::make('spec')->label('Список информации')->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->placeholder('Название')
                            ->required(),
                        TextInput::make('value')
                            ->label('Значение')
                            ->placeholder('Значение')
                            ->required(),
                        FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->directory('main')
                            ->columnSpan('full')
                            ->required(),
                    ])->columns(2),
                    Section::make('Видимость информации')->schema([
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
                    ->label('Оглавление')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Описание')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Статус')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Уведомление')
                            ->icon('heroicon-o-trash')
                            ->iconColor('danger')
                            ->body('Информация была успешно удалена!')
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
                            ->body('Информация была успешно удалена!')
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }

    // Сортировка положения в меню
    public static function getNavigationSort(): ?int
    {
        return 6;
    }
}
