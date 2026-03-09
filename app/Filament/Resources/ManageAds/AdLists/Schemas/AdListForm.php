<?php

namespace App\Filament\Resources\ManageAds\AdLists\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->columnSpanFull()
                ->schema([
                    TextInput::make('title')
                        ->required(),
                    TextInput::make('description'),
                ])
            ]);
    }
}
