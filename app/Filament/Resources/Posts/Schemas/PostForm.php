<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make()
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdatedJs(<<<'JS'
                                function slugify(str) {
                                    return str
                                        .toLowerCase()
                                        .replace(/\s+/g, '-')    // Replace spaces with -
                                        .replace(/\-\-+/g, '-')   // Replace multiple - with single -
                                        .replace(/^-+/, '')       // Trim - from start of text
                                        .replace(/-+$/, '');      // Trim - from end of text
                                }
                                $set('slug', slugify($state));
                            JS),
                            TextInput::make('slug')
                                ->dehydrated()
                                ->required(),
                            RichEditor::make('content')
                                ->placeholder('Write your content here')
                                ->required()
                                ->extraInputAttributes(['style' => 'min-height: 20rem; max-height: 50vh; overflow-y: auto;'])
                                ->columnSpanFull(),
                            /*TextInput::make('meta_title'),
                            Textarea::make('meta_description')
                                ->columnSpanFull(),
                            TextInput::make('meta_keywords'),
                            TextInput::make('canonical_url')
                                ->url(),*/
                        ])
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make()
                        ->schema([
                            Hidden::make('author_id')
                                ->default(fn () => auth()->id()),
                            TextEntry::make('author_name:')
                                ->inlineLabel()
                                ->default(fn (?Post $record): string => $record?->author?->nick_name ?? auth()->user()->nick_name),
                            FileUpload::make('featured_image')
                                ->image()
                                ->directory('posts')
                                ->preserveFilenames(),
                            Select::make('categories')
                                ->label('Categories')
                                ->relationship('categories', 'name') // must match relation name & title attribute
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->required(),
                            /*TextInput::make('author.id')
                                ->label('Author')
                                ->default(auth()->user()->name)
                                ->readOnly(),*/
                            DateTimePicker::make('published_at')
                                ->label('Publish Date')
                                ->default(now())
                                ->native(false)
                                ->required(),
                            ToggleButtons::make('status')
                                ->options(PostStatusEnum::class)
                                ->required()
                                ->grouped()
                                ->default(PostStatusEnum::PUBLISHED),
                        ])
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }
}
