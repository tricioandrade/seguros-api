<?php

namespace App\Enums\Insurance\Policie;

enum PoliceStatusEnum: string
{

    case ACTIVE     = 'Ativa';
    case CANCELED   = 'Cancelada';
    case EXPIRED    = 'Expirada';

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
