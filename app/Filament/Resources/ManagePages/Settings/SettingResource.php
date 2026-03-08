<?php

namespace App\Filament\Resources\ManagePages\Settings;

use App\Filament\Resources\ManagePages\Settings\Pages\EditSetting;
use App\Filament\Resources\ManagePages\Settings\Pages\ListSettings;
use App\Filament\Resources\ManagePages\Settings\Schemas\SettingForm;
use App\Models\FrontPage\Setting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static string | \UnitEnum | null $navigationGroup = 'Pages Management';
    protected static ?int $navigationSort = 50;

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);

    }

    public static function getPages(): array
    {
        return [
            'index' => ListSettings::route('/'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
