<?php

namespace App\Enums;

enum UserType: string
{
    case INTERNAL = 'internal';
    case EXTERNAL = 'external';

    public function names(): string
    {
        return match ($this) {
            self::INTERNAL => 'Internal',
            self::EXTERNAL => 'External',
        };
    }
}
