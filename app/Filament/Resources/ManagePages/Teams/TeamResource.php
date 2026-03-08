<?php

namespace App\Filament\Resources\ManagePages\Teams;

use App\Filament\Resources\ManagePages\Teams\Pages\CreateTeam;
use App\Filament\Resources\ManagePages\Teams\Pages\EditTeam;
use App\Filament\Resources\ManagePages\Teams\Pages\ListTeams;
use App\Models\FrontPage\Team;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Pages Management';
    protected static ?int $navigationSort = 53;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make()
                ->schema([
                    FileUpload::make('image')
                        ->label('Image (size 350x450 pixel)')
                        ->directory('team')
                        ->image()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('350:450')
                        ->imageResizeTargetWidth('350')
                        ->imageResizeTargetHeight('450')
                        ->rules([
                            'image',
                            'mimes:jpg,jpeg,png',  // Allowed file types
                            'max:600',  // 2MB max size
                        ])
                        ->required(),
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('designation')
                        ->required(),
                    TextInput::make('socials.fb')
                        ->label('Facebook Id'),
                    TextInput::make('socials.insta')
                        ->label('Instagram Id'),
                    TextInput::make('socials.linkedin')
                        ->label('LinkedIn Id'),

                ])->columns(5)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular(),
                TextColumn::make('name'),
                TextColumn::make('designation'),
                TextColumn::make('socials.fb')
                    ->label('Facebook'),
                TextColumn::make('socials.insta')
                    ->label('Instagram'),
                TextColumn::make('socials.linkedin')
                    ->label('Linkedin'),
            ])
            ->paginated(false)
            ->recordActions([
                EditAction::make(),
            ])
            ;
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
            'index' => ListTeams::route('/'),
            'create' => CreateTeam::route('/create'),
            'edit' => EditTeam::route('/{record}/edit'),
        ];
    }
}
