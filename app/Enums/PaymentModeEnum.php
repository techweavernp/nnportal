<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentModeEnum: string implements HasColor, HasLabel
{
    case BANK = 'B';
    case CASH = 'C';
    case CHEQUE = 'Q';
    case ONLINE = 'O';


    public function getColor(): string|array|null
    {
        return match ($this){
            self::BANK => 'success',
            self::CASH => 'gray',
            self::CHEQUE => 'warning',
            self::ONLINE => 'primary',
        };

    }

    public function getLabel(): ?string
    {
        return match ($this){
            self::BANK => 'Bank',
            self::CASH => 'Cash',
            self::CHEQUE => 'Cheque',
            self::ONLINE => 'Online',
        };
    }
}
