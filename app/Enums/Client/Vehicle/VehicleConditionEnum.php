<?php

namespace App\Enums\Client\Vehicle;

enum VehicleConditionEnum: string
{
    case NEW        = 'Novo';
    case USED       = 'Usado';
    case SALVAGE    = 'Sinistrado';
    case REBUILT    = 'Reconstruído';
    case LIKE_NEW   = 'Como Novo';
    case EXCELLENT  = 'Excelente';
    case GOOD       = 'Bom';
    case FAIR       = 'Regular';
    case POOR       = 'Ruim';

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
