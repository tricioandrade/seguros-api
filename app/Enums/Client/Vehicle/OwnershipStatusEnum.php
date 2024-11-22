<?php

namespace App\Enums\Client\Vehicle;

enum OwnershipStatusEnum: string
{
    case OWNED      = 'Proprietário';
    case LEASED     = 'Alugado';
    case FINNANCED  = 'Financiado';
    case COMMERCIAL = 'Comercial';
    case OTHER      = 'Outro';
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
