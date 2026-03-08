<?php

namespace App\Filament\Resources\ManagePages\Abouts\Pages;

use App\Filament\Resources\ManagePages\Abouts\AboutResource;
use Filament\Resources\Pages\ListRecords;

class ListAbouts extends ListRecords
{
    protected static string $resource = AboutResource::class;

    public function mount(): void
    {
        redirect()->to(AboutResource::getUrl('edit', ['record' => 1]));
    }
}
