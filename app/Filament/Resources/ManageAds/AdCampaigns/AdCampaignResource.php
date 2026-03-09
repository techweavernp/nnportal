<?php

namespace App\Filament\Resources\ManageAds\AdCampaigns;

use App\Filament\Resources\ManageAds\AdCampaigns\Pages\CreateAdCampaign;
use App\Filament\Resources\ManageAds\AdCampaigns\Pages\EditAdCampaign;
use App\Filament\Resources\ManageAds\AdCampaigns\Pages\ListAdCampaigns;
use App\Filament\Resources\ManageAds\AdCampaigns\Schemas\AdCampaignForm;
use App\Filament\Resources\ManageAds\AdCampaigns\Tables\AdCampaignsTable;
use App\Models\AdCampaign;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdCampaignResource extends Resource
{
    protected static ?string $model = AdCampaign::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;
    protected static string | \UnitEnum | null $navigationGroup = 'Ads Management';
    protected static ?int $navigationSort = 22;

    public static function form(Schema $schema): Schema
    {
        return AdCampaignForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdCampaignsTable::configure($table);
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
            'index' => ListAdCampaigns::route('/'),
            'create' => CreateAdCampaign::route('/create'),
            'edit' => EditAdCampaign::route('/{record}/edit'),
        ];
    }
}
