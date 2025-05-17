<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductGroupResource\Pages;
use App\Models\ProductGroup;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;

class ProductGroupResource extends Resource
{
    protected static ?string $model = ProductGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nazwa kategorii')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state)))
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->reactive()
                    ->maxLength(255)
                    ->unique(ProductGroup::class, 'slug', ignoreRecord: true),

                Select::make('parent_id')
                    ->label('Rodzic')
                    ->options(ProductGroup::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nazwa')->searchable(),
                TextColumn::make('slug')->label('Slug')->searchable(),
                TextColumn::make('parent.name')->label('Rodzic'),
            ])
            ->filters([
                // Add filters if needed
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
            'index' => Pages\ListProductGroups::route('/'),
            'create' => Pages\CreateProductGroup::route('/create'),
            'edit' => Pages\EditProductGroup::route('/{record}/edit'),
        ];
    }
}
