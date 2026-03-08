<?php

namespace App\Filament\Resources\ChangePasswords;

use App\Filament\Resources\ChangePasswords\Pages\ManageChangePasswords;
use App\Filament\Resources\ChangePasswords\Schemas\ChangePasswordForm;
use App\Models\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

class ChangePasswordResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getBreadcrumb(): string
    {
        return '';
    }

    public static function form(Schema $schema): Schema
    {
        return ChangePasswordForm::configure($schema);
    }

    public static function getPages(): array
    {
        return [
            'edit' => ManageChangePasswords::route('/{record}/edit'),
        ];
    }
}
