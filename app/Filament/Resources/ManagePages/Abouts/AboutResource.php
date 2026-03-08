<?php

namespace App\Filament\Resources\ManagePages\Abouts;

use App\Filament\Resources\ManagePages\Abouts\Pages\EditAbout;
use App\Filament\Resources\ManagePages\Abouts\Pages\ListAbouts;
use App\Models\FrontPage\About;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Pages Management';
    protected static ?int $navigationSort = 51;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Fieldset::make()
                            ->schema([
                                TextInput::make('title')
                                    ->required(),
                                FileUpload::make('image')
                                    ->label('Image (Size 444 x 440 pixel)')
                                    ->directory('about-page')
                                    ->image()
                                    ->imageAspectRatio('444:440')
                                    ->automaticallyResizeImagesToWidth('444')
                                    ->automaticallyResizeImagesToHeight('440')
                                    ->required()
                                    ->rules([
                                        'image',
                                        'mimes:jpg,jpeg,png',
                                        'max:600',
                                    ]),
                                RichEditor::make('description')
                                    ->required(),
                                Textarea::make('excerpt')
                                    ->rows(5)
                                    ->required(),
                            ])->columns(1)
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Fieldset::make()
                            ->inlineLabel()
                            ->schema([
                                TextInput::make('counter.team_member')
                                    ->label('Members')
                                    ->numeric(),
                                TextInput::make('counter.satisfied_client')
                                    ->label('Clients')
                                    ->numeric(),
                                TextInput::make('counter.case_files')
                                    ->numeric(),
                                TextInput::make('counter.projects')
                                    ->numeric(),
                            ])->columns(1),
                        ])->columnSpan(['lg' => 1]),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table;
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
            'index' => ListAbouts::route('/'),
            'edit' => EditAbout::route('/{record}/edit'),
        ];
    }
}
