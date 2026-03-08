<?php

namespace App\Filament\Pages\Settings;

use Filament\Pages\Page;

class SystemManagePage extends Page
{
    protected string $view = 'filament.pages.system-manage-page';
    protected static bool $shouldRegisterNavigation = false;
}
