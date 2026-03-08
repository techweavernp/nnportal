<?php

namespace App\Filament\Resources\ManagePages\Contacts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make()
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('header_bg_image')
                            ->label('Header Background Image')
                            ->directory('contact-page')
                            ->image()
                            ->imageAspectRatio('16:9')
                            ->automaticallyResizeImagesMode('cover')
                            ->automaticallyResizeImagesToWidth('1920')
                            ->automaticallyResizeImagesToHeight('1080')
                            ->openable(),
                        Textarea::make('google_map')
                            ->rows(5),
                        KeyValue::make('info')
                            ->label('Address')
                            ->editableKeys(false) // Users can't change 'address1'
                            ->addable(false)  // Users can't add 'address3'
                            ->deletable(false) // Users can't remove rows
                            ->columnSpanFull()
                    ])->columns(3)
            ]);
    }
}
