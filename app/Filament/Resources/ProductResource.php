<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\ProductGroup;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('part_number')
                    ->label('SKU')
                    ->required()
                    ->unique(Product::class, 'part_number', ignoreRecord: true)
                    ->maxLength(100),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (Get $get, $set) => $set('slug', Str::slug($get('part_number'))))
                    ->maxLength(255)
                    ->unique(Product::class, 'slug', ignoreRecord: true),

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

                TextInput::make('short_description')
                    ->label('Opis krótki')
                    ->maxLength(255),

                Textarea::make('meta_description')
                    ->label('Opis meta')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktywny')
                    ->required(),

                FileUpload::make('background')
                    ->label('Obrazek')
                    ->disk('public')
                    ->directory('products')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('part_number')->label('SKU')->searchable(),
                TextColumn::make('manufacturer.name')->label('Producent')->searchable(),
                TextColumn::make('group.name')->label('Kategoria')->searchable(),
                TextColumn::make('short_description')->label('Opis'),
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
