<?php

namespace App\Filament\Resources\ManageAds\Clients\Pages;

use App\Filament\Resources\ManageAds\Clients\ClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->modalWidth('sm'),
        ];
    }
}
