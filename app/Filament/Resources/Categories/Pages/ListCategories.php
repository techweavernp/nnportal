<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->modalWidth('md'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'menu' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('show_in_menu', true)),
            'others' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('show_in_menu', false)),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'menu';
    }
}
