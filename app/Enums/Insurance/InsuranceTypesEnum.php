<?php

namespace App\Enums\Insurance;

enum InsuranceTypesEnum: string
{
    case VEHICLE    = 'Veículo';
    case ACCIDENT   = 'Acidente';
    case TRAVEL     = 'Viagens';

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
