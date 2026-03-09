<?php

namespace App\Filament\Resources\ManageAds\AdCampaigns\Pages;

use App\Filament\Resources\ManageAds\AdCampaigns\AdCampaignResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdCampaign extends EditRecord
{
    protected static string $resource = AdCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
