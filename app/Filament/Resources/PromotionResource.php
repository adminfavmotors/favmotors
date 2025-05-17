<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Promocje';
    protected static ?string $pluralLabel     = 'Promocje';
    protected static ?string $modelLabel      = 'Promocja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
		TextInput::make('title')
		    ->label('Tytuł promocji')
		    ->required()
		    ->reactive()   // теперь изменения будут «слушаться»
		    ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state)))
		    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->reactive()
		    ->unique(Promotion::class, 'slug', ignoreRecord: true)
                    ->default(fn (Get $get) => Str::slug($get('title')))
                    ->maxLength(255),

                TextInput::make('url')
                    ->label('Link docelowy')
                    ->default(fn (Get $get) => '/promotions/' . $get('slug'))
                    ->disabled()
                    ->required(),

                FileUpload::make('background')
                    ->label('Obraz tła')
                    ->disk('public')
                    ->directory('promos')
                    ->image()
                    ->maxSize(1024)
                    ->preserveFilenames()
                    ->enableOpen()
                    ->required(),

		RichEditor::make('subtext')
		    ->label('Treść akcji (Lista)')
		    ->columnSpanFull()
		    ->visible(fn (Get $get) => $get('display_mode') === 'list'),

                Toggle::make('is_active')
                    ->label('Aktywna')
                    ->required(),

                TextInput::make('sort_order')
                    ->label('Kolejność')
                    ->required()
                    ->numeric()
                    ->default(0),
		Select::make('display_mode')
		    ->label('Tryb wyświetlania')
		    ->options(['grid' => 'Siatka', 'list' => 'Lista',
    ])
    ->default('grid')
    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('url'),
                ImageColumn::make('background')->disk('public')->rounded()->height(50),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('sort_order')->numeric()->sortable(),
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}

