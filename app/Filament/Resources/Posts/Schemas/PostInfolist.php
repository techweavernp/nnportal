<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Post;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                ->columnSpanFull()
                ->schema([
                    TextEntry::make('canonical_url')
                        ->default(fn ($record): string => 'https://nepalnewsportal.com/post/'.$record->slug)
                        ->url(fn ($record): string => 'https://nepalnewsportal.com/post/'.$record->slug)
                        ->openUrlInNewTab('_blank'),
                    ImageEntry::make('featured_image')
                        ->placeholder('-'),
                    TextEntry::make('title'),
                    TextEntry::make('content')
                        ->markdown()
                        ->columnSpanFull(),
                    TextEntry::make('author.name')
                        ->label('Author'),
                    TextEntry::make('status')
                        ->badge(),
                    TextEntry::make('published_at')
                        ->dateTime()
                        ->placeholder('-'),
                    TextEntry::make('views_count')
                        ->numeric(),
                    TextEntry::make('shares_count')
                        ->numeric(),
                    TextEntry::make('meta_title')
                        ->placeholder('-'),
                    TextEntry::make('meta_description')
                        ->placeholder('-')
                        ->columnSpanFull(),
                    TextEntry::make('meta_keywords')
                        ->placeholder('-'),
                    TextEntry::make('created_at')
                        ->dateTime()
                        ->placeholder('-'),

                ])

            ]);
    }
}
