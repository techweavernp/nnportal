<?php

namespace App\Filament\Resources\ChangePasswords\Schemas;

use App\Filament\Components\ChangePasswordSchema;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class ChangePasswordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make()
                    ->columnSpanFull()
                    ->schema(ChangePasswordSchema::make())->columns(3),
            ]);
    }
}
