<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->maxLength(255),
                FileUpload::make('image_path')
                    ->label('Obraz')
                    ->image()
		    ->disk('public')
                    ->directory('banners')
                    ->required(),
                TextInput::make('link_url')
                    ->label('URL linku')
                    ->maxLength(255)
		    ->nullable(),
                Toggle::make('is_active')
                    ->label('Aktywny'),
                TextInput::make('sort_order')
                    ->label('Kolejność')
                    ->numeric()
                    ->default(0),

                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
	->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('title')->label('Tytuł')->searchable()->sortable(),
	    ImageColumn::make('image_path')
    		->label('Obraz')
    		->getStateUsing(fn ($record) => $record->image_path
       		 ? asset('storage/' . $record->image_path)
        		: null
    	)
    		->rounded()
    		->height(50),
            ToggleColumn::make('is_active')->label('Aktywny')->sortable(),
            TextColumn::make('sort_order')->label('Kolejność')->sortable(),
            TextColumn::make('created_at')
                ->label('Utworzono')
                ->dateTime('d.m.Y H:i'),
        ])
        ->filters([
            Tables\Filters\TernaryFilter::make('is_active')
                ->label('Aktywny')
                ->trueLabel('Tak')
                ->falseLabel('Nie'),
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
                //
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
