<?php

namespace App\Filament\Resources\ChangePasswords\Pages;

use App\Filament\Resources\ChangePasswords\ChangePasswordResource;
use Filament\Resources\Pages\EditRecord;

class ManageChangePasswords extends EditRecord
{
    protected static string $resource = ChangePasswordResource::class;

    protected static ?string $title = 'Change Password';

    public function getBreadcrumb(): string
    {
        return '';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return "Password Changed Successfully.";
    }
}
