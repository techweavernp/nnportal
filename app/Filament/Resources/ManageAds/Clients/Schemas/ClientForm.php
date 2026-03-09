<?php

namespace App\Filament\Resources\ManageAds\Clients\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->columnSpanFull()
                ->inlineLabel()
                ->schema([
                    TextInput::make('organization')
                        ->required(),
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('address'),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->unique(),
                    TextInput::make('mobile')
                        ->maxLength(10)
                        ->numeric()
                        ->required(),
                ])
            ]);
    }
}
