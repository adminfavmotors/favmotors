<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Category;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Produkty';
    protected static ?string $pluralLabel = 'Produkty';
    protected static ?string $modelLabel = 'Produkt';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Section::make('Podstawowe informacje')
                ->schema([
                    TextInput::make('product_code')
                        ->label('Kod produktu')
                        ->maxLength(255),

                    TextInput::make('name')
                        ->label('Nazwa produktu')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('slug')
                        ->label('Adres URL')
                        ->required()
                        ->unique(Product::class, 'slug', ignoreRecord: true)
                        ->maxLength(255),

                    Select::make('category_id')
                        ->label('Kategoria')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('manufacturer')
                        ->label('Producent')
                        ->maxLength(255),
                ]),

            Section::make('Ceny i magazyn')
                ->schema([
                    TextInput::make('purchase_price_netto')->label('Cena zakupu netto')->numeric(),
                    TextInput::make('purchase_price_brutto')->label('Cena zakupu brutto')->numeric(),
                    TextInput::make('sale_price_netto')->label('Cena sprzedaży netto')->numeric(),
                    TextInput::make('sale_price_brutto')->label('Cena sprzedaży brutto')->numeric(),
                    TextInput::make('markup_percentage')->label('Marża (%)')->numeric()->default(0),
                    TextInput::make('stock')->label('Stan magazynowy')->numeric()->required(),
                    TextInput::make('sku')->label('Kod SKU')->maxLength(255),
                    TextInput::make('delivery_time')->label('Czas dostawy')->maxLength(255),
                ]),

            Section::make('Dodatkowe informacje')
                ->schema([
                    Textarea::make('description')->label('Opis')->rows(3),
                    Textarea::make('specification')->label('Specyfikacja')->rows(3),
                    Textarea::make('application')->label('Zastosowanie')->rows(3),
                    Textarea::make('replacements')->label('Zamienniki')->rows(3),
                    Textarea::make('oe_codes')->label('Kody OE')->rows(3),
                ]),
        ]);
}

	public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nazwa'),
                Tables\Columns\TextColumn::make('price')->label('Cena')->money('PLN'),
                Tables\Columns\TextColumn::make('stock')->label('Stan'),
                Tables\Columns\TextColumn::make('category.name')->label('Kategoria'),
            ])
            ->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
