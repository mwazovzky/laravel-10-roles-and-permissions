<?php

namespace App\Enums\Transactions;

enum Status: string
{
    case CREATED = 'created';
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
