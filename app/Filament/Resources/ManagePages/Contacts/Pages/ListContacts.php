<?php

namespace App\Filament\Resources\ManagePages\Contacts\Pages;

use App\Filament\Resources\ManagePages\Contacts\ContactResource;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    public function mount(): void
    {
        redirect()->to(ContactResource::getUrl('edit', ['record' => 1]));
    }
}
