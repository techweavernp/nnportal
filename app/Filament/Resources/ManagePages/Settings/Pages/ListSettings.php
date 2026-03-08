<?php

namespace App\Filament\Resources\ManagePages\Settings\Pages;

use App\Filament\Resources\ManagePages\Settings\SettingResource;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    public function mount(): void
    {
        redirect()->to(SettingResource::getUrl('edit', ['record' => 1]));
    }
}
