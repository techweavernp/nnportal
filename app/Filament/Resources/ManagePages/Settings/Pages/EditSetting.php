<?php

namespace App\Filament\Resources\ManagePages\Settings\Pages;

use App\Filament\Resources\ManagePages\Settings\SettingResource;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;
    protected ?string $heading = 'Settings';

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }
}
