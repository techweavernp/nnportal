<?php

namespace App\Filament\Resources\ManagePages\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Meta Content')
                            ->inlineLabel()
                            ->schema([
                                TextInput::make('meta_content.title')
                                    ->label('Meta Title')
                                    ->nullable(),
                                Textarea::make('meta_content.description')
                                    ->label('Meta Description')
                                    ->nullable(),
                                FileUpload::make('meta_content.image')
                                    ->directory('images'),
                            ]),
                        Tab::make('Header Content')
                            ->schema([
                                KeyValue::make('header_content')
                                    ->hiddenLabel()
                                    ->editableKeys(false) // Users can't change 'address1'
                                    ->addable(false)  // Users can't add 'address3'
                                    ->deletable(false) // Users can't remove rows
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Footer Content')
                            ->schema([
                                KeyValue::make('footer_content')
                                    ->hiddenLabel()
                                    ->editableKeys(false) // Users can't change 'address1'
                                    ->addable(false)  // Users can't add 'address3'
                                    ->deletable(false) // Users can't remove rows
                                    ->columnSpanFull(),
                            ]),
                        Tab::make('Hero Image')
                            ->inlineLabel()
                            ->schema([
                                FileUpload::make('hero_image.image_1')
                                    ->label('Hero Image')
                                    ->directory('home-page')
                                    ->columnSpan(1),
                                TextInput::make('hero_image.alt_1')
                                    ->label('Alt Text'),
                                Textarea::make('hero_image.description')
                                    ->label('Short Description')
                                    ->rows(3)
                                    ->columnSpan(1),
                                TextInput::make('hero_image.title')
                                    ->label('Title'),
                            ])->columns(2),
                        Tab::make('Why Choose Us')
                            ->inlineLabel()
                            ->schema([
                                Textarea::make('why_choose_us.description')
                                    ->label('Why Choose Us')
                                    ->rows(3),
                            ]),
                    ])->columnSpanFull(),

            ]);
    }
}
