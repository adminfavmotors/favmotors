<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\ProductGroup;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Produkty';
    protected static ?string $pluralLabel     = 'Produkty';
    protected static ?string $modelLabel      = 'Produkt';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nazwa')
                    ->required()
                    ->maxLength(255),

                TextInput::make('part_number')
                    ->label('SKU')
                    ->required()
                    ->unique(Product::class, 'part_number', ignoreRecord: true)
                    ->maxLength(100),

		TextInput::make('slug')
		    ->label('Slug')
		    ->required()
		    ->reactive()
		    ->afterStateUpdated(function (Get $get, $set) {
	        // Получаем название производителя по ID (если выбран)
	        $manufacturerName = '';
	        if ($get('manufacturer_id')) {
	        $manufacturer = \App\Models\Manufacturer::find($get('manufacturer_id'));
	        if ($manufacturer) {
                $manufacturerName = $manufacturer->name . ' ';
            }
        }
	        // Собираем slug: "бренд + название + артикул"
	        $slugBase = trim($manufacturerName . ($get('name') ?? '') . ' ' . ($get('part_number') ?? ''));
	        $set('slug', \Illuminate\Support\Str::slug($slugBase, '-'));
	    })
		    ->maxLength(255)
		    ->unique(\App\Models\Product::class, 'slug', ignoreRecord: true),

                Select::make('manufacturer_id')
                    ->label('Producent')
                    ->options(Manufacturer::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('article_group_id')
                    ->label('Kategoria')
                    ->options(ProductGroup::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),

                TextInput::make('purchase_price_netto')
                    ->label('Cena zakupu netto')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),

                TextInput::make('purchase_price_brutto')
                    ->label('Cena zakupu brutto')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),

                TextInput::make('sale_price_netto')
                    ->label('Cena sprzedaży netto')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),

                TextInput::make('sale_price_brutto')
                    ->label('Cena sprzedaży brutto')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),

                TextInput::make('margin_percent')
                    ->label('Marża (%)')
                    ->numeric()
                    ->step(0.01)
                    ->nullable(),

                TextInput::make('delivery')
                    ->label('Dostawa')
                    ->maxLength(255)
                    ->nullable(),

                Textarea::make('specification')
                    ->label('Specyfikacja')
                    ->columnSpan('full')
                    ->nullable(),

                Textarea::make('usage')
                    ->label('Zastosowanie')
                    ->columnSpan('full')
                    ->nullable(),

                Textarea::make('replacements')
                    ->label('Zamienniki')
                    ->columnSpan('full')
                    ->nullable(),

                Textarea::make('oe_codes')
                    ->label('Kody OE')
                    ->columnSpan('full')
                    ->nullable(),

                Toggle::make('is_active')
                    ->label('Aktywny')
                    ->required(),

                FileUpload::make('background')
                    ->label('Obrazek')
                    ->disk('public')
                    ->directory('products')
                    ->image()
                    ->nullable(),

                Textarea::make('description')
                    ->label('Opis')
                    ->columnSpan('full'),

                Forms\Components\Repeater::make('crosses')
                    ->label('Krosy')
                    ->schema([
                        TextInput::make('0')->label('Kros'),
                    ])
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('part_number')->label('SKU')->searchable(),
                TextColumn::make('manufacturer.name')->label('Producent'),
                TextColumn::make('group.name')->label('Kategoria'),
                TextColumn::make('sale_price_brutto')->label('Cena')->money('pln'),
                IconColumn::make('is_active')->label('Aktywny'),
            ])
            ->filters([
                Filter::make('active')
                    ->query(fn ($query) => $query->where('is_active', true))
                    ->label('Aktywne'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
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
