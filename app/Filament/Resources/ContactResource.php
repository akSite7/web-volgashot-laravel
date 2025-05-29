<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use Filament\Forms\Components\Section;
use App\Models\Contact;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
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
                            ->maxLength(255)
                            ->placeholder('Название организации')
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
            ->columns([
                TextColumn::make('title')
                    ->label('Полное название')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Название организации')
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
}
