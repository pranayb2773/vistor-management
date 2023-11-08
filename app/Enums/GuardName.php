<?php

namespace App\Enums;

enum GuardName: string
{
    case WEB = 'web';
    case API = 'api';

    public function names(): string
    {
        return match ($this) {
            self::API => 'API',
            self::WEB => 'WEB',
        };
    }
}
