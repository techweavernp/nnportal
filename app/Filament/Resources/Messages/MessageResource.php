<?php

namespace App\Filament\Resources\Messages;

use App\Filament\Resources\Messages\Pages\ListMessages;
use App\Models\FrontPage\Message;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('mobile'),
                TextInput::make('subject')
                    ->columnSpanFull(),
                Textarea::make('message')
                    ->rows(5)
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->label('Read Status'),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime(format: 'M j, Y H:i')
                    ->sortable(),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('subject')
                    ->wrap(),
                TextColumn::make('message')
                    ->wrap()
                    ->limit(50),
                ToggleColumn::make('is_read')
                    ->label('Read Status')
                    /*->action(function($record, $column) {
                        $name = $column->getName();
                        $record->update([
                            $name => !$record->$name
                        ]);
                    })*/,
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->slideOver(),
                /*Action::make('Mark Read')
                    ->label('Mark Read')
                    ->visible(fn($record) => !$record->is_read)
                    ->action(function ($record){
                        if(!$record->is_read){
                            $record->is_read = true;
                            $record->save();
                        }
                    })
                    ->icon('heroicon-o-hand-thumb-up')
                    ->requiresConfirmation(),*/
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
            'index' => ListMessages::route('/'),
        ];
    }
}
