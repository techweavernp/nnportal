<?php

namespace App\Filament\Resources\ManageAds\AdLists\Pages;

use App\Filament\Resources\ManageAds\AdLists\AdListResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdLists extends ListRecords
{
    protected static string $resource = AdListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->modalWidth('sm'),
        ];
    }
}
