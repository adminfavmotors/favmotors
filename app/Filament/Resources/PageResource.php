<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;


class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
	    Forms\Components\TextInput::make('title')
		 ->label('Tytuł')
		 ->required()
		 ->reactive()
		->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug((string) $state, '_')))
		    ->maxLength(255),
            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
		->reactive()
                ->maxLength(255)
                ->unique(Page::class, 'slug', ignoreRecord: true),

            Forms\Components\RichEditor::make('content')
                ->label('Treść')
                ->toolbarButtons([
                    'bold', 'italic', 'link', 'bulletList', 'orderedList'
                ])
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktywna')
                ->default(true),

            Forms\Components\TextInput::make('sort_order')
                ->label('Kolejność')
                ->numeric()
                ->default(0),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
	    Tables\Columns\TextColumn::make('title')->label('Tytuł')->sortable(),
            Tables\Columns\TextColumn::make('slug')->label('Slug')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Aktywna'),
            Tables\Columns\TextColumn::make('sort_order')->label('Kolejność')->sortable(),
            Tables\Columns\TextColumn::make('updated_at')->label('Zaktualizowano')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
