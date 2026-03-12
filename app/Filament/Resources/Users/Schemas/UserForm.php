<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserForm
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
                    TextInput::make('nick_name')
                        ->required(),
                    TextInput::make('email')
                        ->email()
                        ->unique(ignoreRecord: true)
                        ->required(),
                    TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->dehydrated(fn($state): bool => filled($state))
                        ->dehydrateStateUsing(fn($state): string => Hash::make($state))
                        ->required(fn(string $operation): bool => $operation === 'create'),
                    Select::make('roles')
                        ->relationship('roles', 'name',
                            fn(Builder $query) => $query->where('name', '!=', 'super_admin'))
                        ->preload(),
                ])->columns(2)
            ]);
    }
}
