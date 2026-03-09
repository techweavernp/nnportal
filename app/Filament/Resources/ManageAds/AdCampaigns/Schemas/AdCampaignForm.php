<?php

namespace App\Filament\Resources\ManageAds\AdCampaigns\Schemas;

use App\Enums\PaymentModeEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdCampaignForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                ->schema([
                    Section::make()
                    ->columnSpanFull()
                    ->schema([
                        Select::make('client_id')
                            ->relationship('client', 'name')
                            ->required(),
                        Select::make('ad_list_id')
                            ->relationship('adList', 'title')
                            ->required(),
                        TextInput::make('display_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        FileUpload::make('image')
                            ->image()
                            ->directory('ads')
                            ->required()
                            ->columnSpanFull(),
                        DateTimePicker::make('start_date')
                            ->native(false)
                            ->default(now()),
                        DateTimePicker::make('end_date')
                            ->native(false)
                            ->default(now()),
                        TextInput::make('link_url')
                            ->placeholder('https://example.com')
                            ->url()
                            ->columnSpan(2),
                    ])->columns(3)
                ])->columnSpan(['lg'=>2]),

                Group::make()
                    ->schema([
                        Section::make()
                        ->schema([
                            TextInput::make('payment_amount')
                                ->numeric()
                                ->prefix('NRs')
                                ->default(0),
                            DateTimePicker::make('payment_date')
                                ->native(false)
                                ->default(now()),
                            ToggleButtons::make('payment_mode')
                                ->default(PaymentModeEnum::CASH)
                                ->options(PaymentModeEnum::class),
                            Toggle::make('is_paid'),
                        ])
                    ])->columnSpan(['lg'=>1]),
            ])->columns(3);
    }
}
