<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PostStatusEnum: int implements HasColor, HasLabel
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case SCHEDULE = 2;
    case ARCHIVED = 3;


    public function getColor(): string|array|null
    {
        return match ($this){
            self::DRAFT => 'info',
            self::PUBLISHED => 'success',
            self::SCHEDULE => 'warning',
            self::ARCHIVED => 'danger',
        };

    }

    public function getLabel(): ?string
    {
        return match ($this){
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::SCHEDULE => 'Schedule',
            self::ARCHIVED => 'Archived',
        };
    }
}
