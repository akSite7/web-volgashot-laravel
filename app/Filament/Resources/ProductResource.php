<?php

namespace App\Filament\Resources;

use App\Models\Product;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\ProductResource\Pages;
// Добавленные use
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationLabel = 'Товары';
    protected static ?string $modelLabel = 'Товары';
    protected static ?string $pluralModelLabel = 'Товары';
    protected static ?string $navigationGroup = 'Магазин';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основные данные')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Название товара')
                            ->placeholder('Название')
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) { $set('product_slug', Str::slug($state)); })
                            ->required(),
                        TextInput::make('product_slug')
                            ->label('URL')
                            ->placeholder('URL')
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->disabled()
                            ->dehydrated()
                            ->unique(Product::class, 'product_slug', ignoreRecord: true)
                            ->required(),
                        TextInput::make('price')
                            ->label('Цена')
                            ->placeholder('Цена')
                            ->maxLength(50)
                            ->suffix('₽')
                            ->required(),
                        Select::make('category_id')
                            ->label('Категория')
                            ->placeholder('Выбрать категорию')
                            ->relationship('category', 'name')
                            ->preload()
                            ->native(false)
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Название категории')
                                    ->placeholder('Название категории')
                                    ->maxLength(255)
                                    ->required(),
                                TextInput::make('category_slug')
                                    ->label('URL категории')
                                    ->placeholder('URL категории')
                                    ->maxLength(255)
                                    ->suffixIcon('heroicon-m-globe-alt')
                                    ->required(),
                                TextArea::make('description')
                                    ->label('Описание')
                                    ->placeholder('Описание')
                                    ->autosize()
                                    ->required(),
                                Toggle::make('is_active')
                                    ->label('Отключена / Включена')
                                    ->default(true)
                                    ->required(),
                            ])
                            ->required(),
                    ]),
                    TextArea::make('description')
                            ->label('Описание')
                            ->placeholder('Описание')
                            ->autosize()
                            ->required(),
                    Section::make('Медиа и изображения')->schema([
                        FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->directory('products')
                            ->required(),
                    ]),
                ]),
                Section::make('Видимость товара')->schema([
                    Toggle::make('is_active')
                        ->label('Отключена / Включена')
                        ->default(true)
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        
        return $table
            // Сортировка по последним созданным товарам
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Изображение'),
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Описание')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->sortable(),
                TextColumn::make('product_slug')
                    ->label('URL')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Категория')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Наличие'),
            ])
            ->filters([
                // Фильтр по категориям
                SelectFilter::make('category')
                    ->label('Категории')
                    ->relationship('category', 'name'),
            ])
            // Сообщение при отсутствии заказов
            ->emptyStateHeading('Товары не найдены')
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Уведомление')
                            ->icon('heroicon-o-trash')
                            ->iconColor('danger')
                            ->body('Товар был успешно удален!')
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
                            ->body('Товар был успешно удален!')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    // Добавляет счетчик количества товаров
    public static function getNavigationBadge(): ?string 
    {
        return static::getModel()::count();
    }

    // Возвращает массив категорий
    public static function categoryOptions()
    {
        return Category::pluck('name', 'id');
    }

    // Сортировка положения в меню
    public static function getNavigationSort(): ?int
    {
        return 4;
    }
}
