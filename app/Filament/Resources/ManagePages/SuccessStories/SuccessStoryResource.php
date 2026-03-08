<?php

namespace App\Filament\Resources\ManagePages\SuccessStories;

use App\Filament\Resources\ManagePages\SuccessStories\Pages\CreateSuccessStory;
use App\Filament\Resources\ManagePages\SuccessStories\Pages\EditSuccessStory;
use App\Filament\Resources\ManagePages\SuccessStories\Pages\ListSuccessStories;
use App\Models\FrontPage\SuccessStory;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SuccessStoryResource extends Resource
{
    protected static ?string $model = SuccessStory::class;
    protected static string | \UnitEnum | null $navigationGroup = 'Pages Management';
    protected static ?int $navigationSort = 54;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make()
                ->schema([
                    TextInput::make('tiktok_video_url')
                        ->required()
                        ->columnSpanFull(),
                    Toggle::make('show_hide')
                        ->default(true)
                        ->required(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tiktok_video_url')
                    ->url(fn ($record) => $record->tiktok_video_url)
                    ->openUrlInNewTab(),
                ToggleColumn::make('show_hide'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSuccessStories::route('/'),
            'create' => CreateSuccessStory::route('/create'),
            'edit' => EditSuccessStory::route('/{record}/edit'),
        ];
    }
}
