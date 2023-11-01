<?php

namespace App\Enums\Insurance\Vehicle;

enum FractionationTypesEnum: string
{
    case YEARLY     = 'Anual';
    case SEMIANNUAL = 'Semestral';
    case QUARTERLY = 'Trimestral';

    /**
     * Return all cases values as array
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Return all cases names as array
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }
}
