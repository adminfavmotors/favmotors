<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    /**
     * Override the base query to prevent loading all records when no search is entered.
     */
    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();
        $search = $this->getTableSearch();

        // If no search term provided, return empty result set
        if (empty($search)) {
            return $query->whereRaw('0 = 1');
        }

        return $query;
    }

    /**
     * Set a fixed number of records per page.
     */
    public function getTableRecordsPerPage(): int
    {
        return 20;
    }

    /**
     * Disable the default global search to avoid full-table LIKE queries.
     */
    public static function canGloballySearch(): bool
    {
        return false;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
