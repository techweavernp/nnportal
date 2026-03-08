<?php

namespace App\Filament\Resources\ManagePages\Contacts;

use App\Filament\Resources\ManagePages\Contacts\Pages\EditContact;
use App\Filament\Resources\ManagePages\Contacts\Pages\ListContacts;
use App\Filament\Resources\ManagePages\Contacts\Schemas\ContactForm;
use App\Models\FrontPage\Contact;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Pages Management';
    protected static ?int $navigationSort = 52;

    public static function form(Schema $schema): Schema
    {
        return ContactForm::configure($schema);

    }

    public static function getPages(): array
    {
        return [
            'index' => ListContacts::route('/'),
            'edit' => EditContact::route('/{record}/edit'),
        ];
    }
}
