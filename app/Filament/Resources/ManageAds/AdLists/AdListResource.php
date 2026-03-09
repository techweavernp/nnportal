<?php

namespace App\Filament\Resources\ManageAds\AdLists;

use App\Filament\Resources\ManageAds\AdLists\Pages\CreateAdList;
use App\Filament\Resources\ManageAds\AdLists\Pages\EditAdList;
use App\Filament\Resources\ManageAds\AdLists\Pages\ListAdLists;
use App\Filament\Resources\ManageAds\AdLists\Schemas\AdListForm;
use App\Filament\Resources\ManageAds\AdLists\Tables\AdListsTable;
use App\Models\AdList;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdListResource extends Resource
{
    protected static ?string $model = AdList::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNumberedList;
    protected static string | \UnitEnum | null $navigationGroup = 'Ads Management';
    protected static ?int $navigationSort = 21;

    public static function form(Schema $schema): Schema
    {
        return AdListForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdListsTable::configure($table);
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
            'index' => ListAdLists::route('/'),
        ];
    }
}
