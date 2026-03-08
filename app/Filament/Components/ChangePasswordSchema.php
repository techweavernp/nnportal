<?php

namespace App\Filament\Components;

use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class ChangePasswordSchema
{
    public static function make(): array
    {
        return [
            TextInput::make('current_password')
                ->label('Current Password')
                ->password()
                ->revealable()
                ->required()
                ->rule(self::getCurrentPasswordRule()),

            TextInput::make('password')
                ->label('New Password')
                ->confirmed('password_confirmation')
                ->password()
                ->revealable()
                ->live()
                ->partiallyRenderAfterStateUpdated()
                ->belowContent(
                    fn ($state) => match (true) {
                        strlen($state) > 12 => ' 👍 Awesome',
                        strlen($state) > 7 => ' 😀 Yeah okay',
                        strlen($state) > 4 => ' 🥹 Try harder',
                        default => ' ',
                    }
                )
                ->required(),

            TextInput::make('password_confirmation')
                ->password()
                ->label('Confirm New Password')
                ->revealable()
                ->required(),
        ];
    }

    protected static function getCurrentPasswordRule(): callable
    {
        return function () {
            return function ($attribute, $value, $fail) {
                if (! Hash::check($value, auth()->user()->password)) {
                    $fail('The current password is incorrect.');
                }
            };
        };
    }
}
