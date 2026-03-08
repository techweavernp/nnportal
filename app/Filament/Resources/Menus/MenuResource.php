<?php

namespace App\Filament\Resources\Menus;

use App\Filament\Resources\Menus\Pages\CreateMenu;
use App\Filament\Resources\Menus\Pages\EditMenu;
use App\Filament\Resources\Menus\Pages\ListMenus;
use App\Models\FrontPage\Menu;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Menu Item Details')
                    ->description('Basic information for the menu item.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Menu Item Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true) // Update URL/Linkable fields based on name if needed
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                // You can implement auto-slug generation if you had a 'slug' field here,
                                // or perhaps derive a default URL for internal links based on the name.
                            }),

                        Select::make('parent_id')
                            ->label('Parent Menu Item')
                            ->placeholder('No Parent (Top Level)')
                            ->relationship('parent', 'name', fn (Builder $query, ?Model $record) => $query->where('id', '!=', $record?->id ?? 0))
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Radio::make('menu_type')
                            ->label('Menu Location')
                            ->options(Menu::getMenuTypes()) // Use the helper from the model
                            ->default('MM')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('menu_order')
                            ->label('Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first.')
                            ->minValue(0)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Is Active?')
                            ->default(true)
                            ->helperText('Determines if this menu item is visible on the website.'),
                    ])->columns(2),

                Section::make('Link Destination')
                    ->description('Define where this menu item links to.')
                    ->schema([
                        Select::make('link_type')
                            ->label('Link Type')
                            ->options([
                                'url' => 'Custom URL',
                                'page' => 'Internal Page',
                                'post' => 'Internal Post',
                            ])
                            ->default('url')
                            ->live() // Essential for conditional visibility
                            ->afterStateUpdated(function (Set $set) {
                                // Clear linkable_id and url when link type changes
                                $set('linkable_id', null);
                                $set('url', null);
                                $set('linkable_type', null); // Clear this too
                            })
                            ->required(),

                        TextInput::make('url')
                            ->label('Custom URL')
                            ->visible(fn (Get $get): bool => $get('link_type') === 'url')
                            ->url() // Validate as URL
                            ->nullable(),

                        /*Select::make('linkable_id')
                            ->label('Select Page')
                            ->options(Page::all()->pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->visible(fn (Get $get): bool => $get('link_type') === 'page')
                            ->afterStateUpdated(fn (Set $set) => $set('linkable_type', Page::class)) // Set linkable_type to Page::class
                            ->nullable(),

                        Select::make('linkable_id')
                            ->label('Select Post')
                            ->options(Setting::all()->pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->visible(fn (Get $get): bool => $get('link_type') === 'post')
                            ->afterStateUpdated(fn (Set $set) => $set('linkable_type', Setting::class)) // Set linkable_type to Post::class
                            ->nullable(),*/

                        // Hidden fields to store the polymorphic type
                        Hidden::make('linkable_type')
                            ->extraAttributes(['data-linkable-type' => 'true']), // Used for debugging if needed
                    ])->columns(1), // Use 1 column for clarity of conditional fields
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Menu Item')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->placeholder('Top Level')
                    ->sortable(),

                TextColumn::make('menu_type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => Menu::getMenuTypes()[$state] ?? $state)
                    ->badge() // Display as a badge
                    ->colors([
                        'success' => 'MM', // Green for Main Menu
                        'info' => 'FM',    // Blue for Footer Menu
                    ])
                    ->sortable(),

                TextColumn::make('menu_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('linkable_type')
                    ->label('Linked To')
                    ->formatStateUsing(fn (string $state): string => Str::afterLast($state, '\\')) // Show only model name
                    ->badge()
                    ->colors([
                        'primary' => fn (string $state): bool => $state === 'App\\Models\\Page',
                        'success' => fn (string $state): bool => $state === 'App\\Models\\Post',
                        'gray' => fn (string $state): bool => $state === null, // For custom URLs
                    ])
                    ->placeholder('Custom URL'),

                TextColumn::make('linkable.title') // Assumes Page and Post models have a 'title' attribute
                ->label('Linked Content')
                    ->placeholder('N/A')
                    ->limit(30)
                    ->tooltip(fn (Model $record): ?string => $record->linkable?->title),

                TextColumn::make('url')
                    ->label('Custom URL')
                    ->url(fn (string $state): string => $state) // Make it clickable
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: true) // Hidden by default in table
                    ->limit(50),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->reorderable('menu_order')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }
}
