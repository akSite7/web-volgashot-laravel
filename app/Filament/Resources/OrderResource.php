<?php

namespace App\Filament\Resources;

use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\OrderResource\Pages;
// Добавленные use
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Заказы';
    protected static ?string $modelLabel = 'Заказы';
    protected static ?string $pluralModelLabel = 'Заказы';
    protected static ?string $navigationGroup = 'Заказы/заявки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Данные заказчика')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('first_name')
                            ->label('Имя')
                            ->placeholder('Имя')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('last_name')
                            ->label('Фамилия')
                            ->placeholder('Фамилия')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('phone')
                            ->label('Номер телефона')
                            ->placeholder('Номер телефона')
                            ->tel()
                            ->mask('+7 (999)-999-99-99')
                            ->regex('/^\+7\s?\(\d{3}\)\-\d{3}\-\d{2}\-\d{2}$/')
                            ->validationMessages([
                                'required' => 'Пожалуйста, введите номер телефона',
                                'regex' => 'Формат номера должен быть: +7 (XXX)-XXX-XX-XX',
                            ])
                            ->required(),
                        TextInput::make('city')
                            ->label('Город')
                            ->placeholder('Город')
                            ->maxLength(255)
                            ->required(),
                    ]),
                    TextInput::make('address')
                        ->label('Адрес')
                        ->placeholder('Адрес')
                        ->maxLength(255)
                        ->required(),
                    TextArea::make('notes')
                        ->label('Комментарий')
                        ->placeholder('Комментарий')
                        ->maxLength(500)
                        ->autosize()
                        ->required(),
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
                        ]),
                ]),
                Section::make('Заказанные товары')->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->label('Товары')
                        ->disabled()
                        ->addable(false)
                        ->schema([
                            Select::make('product_id')
                                ->label('Название товара')
                                ->relationship('product', 'name')
                                ->preload()
                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', (Product::find($state)?->price) ?? 0))
                                ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', (Product::find($state)?->price) ?? 0))
                                ->columnSpan(4),
                            TextInput::make('quantity')
                                ->label('Количество')
                                ->numeric()
                                ->default(1)
                                ->suffix('кг')
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_amount', $state*$get('unit_amount')))
                                ->minValue(1)
                                ->columnSpan(2),
                            TextInput::make('unit_amount')
                                ->label('Цена товара за кг')
                                ->suffix('₽')
                                ->dehydrated()
                                ->disabled()
                                ->columnSpan(3),
                            TextInput::make('total_amount')
                                ->label('Общая сумма')
                                ->suffix('₽')
                                ->dehydrated()
                                ->disabled()
                                ->columnSpan(3),
                        ])->columns(12),
                        Placeholder::make('total_price_placeholder')
                            ->label('Общая сумма заказа')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                if (!$repeaters = $get('items')) {
                                    return $total;
                                }

                                foreach ($repeaters as $key => $repeater) {
                                    $total += $get("items.{$key}.total_amount");
                                }
                                $set('total_price', $total);
                                return number_format($total, 0, '.', ' '). ' ₽';
                            }),
                        Hidden::make('total_price')
                            ->default(0),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // Сортировка по последним заказам
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('first_name')
                    ->label('Имя')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Номер телефона')
                    ->searchable(),
                TextColumn::make('city')
                    ->label('Город')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_price')
                    ->label('Сумма заказа')
                    ->sortable()
                    ->money('RUB'),
                SelectColumn::make('status')
                    ->label('Статус заказа')
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
                    ->dateTime('d/m/o H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            // Сообщение при отсутствии заказов
            ->emptyStateHeading('Заказы не найдены')
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Уведомление')
                            ->icon('heroicon-o-trash')
                            ->iconColor('danger')
                            ->body('Заказ был успешно удален!')
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
                            ->body('Заказ был успешно удален!')
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
        ];
    }

    // Добавляет счетчик количества заказов
    public static function getNavigationBadge(): ?string 
    {
        return static::getModel()::count();
    }

    // Убирает кнопку создать
    public static function canCreate(): bool
    {
        return false;
    }

    // Сортировка положения в меню
    public static function getNavigationSort(): ?int
    {
        return 1;
    }
}
