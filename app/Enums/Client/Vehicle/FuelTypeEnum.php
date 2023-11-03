<?php

namespace App\Enums\Client\Vehicle;

enum FuelTypeEnum: string
{

    case GASOLINE   = 'Gasolina';
    case DIESEL     = 'Gasóleo';
    case ELECTRIC   = 'Eléctrico';
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
