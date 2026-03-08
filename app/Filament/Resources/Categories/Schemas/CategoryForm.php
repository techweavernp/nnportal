<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('slug')
                        ->required(),
                    Select::make('parent_id')
                        ->relationship('parent', 'name'),
                    TextInput::make('display_order')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->default(1),
                    Toggle::make('is_active')
                        ->required(),
                    Toggle::make('show_in_menu')
                        ->required(),
                ])->columns(2)
            ]);
    }
}
