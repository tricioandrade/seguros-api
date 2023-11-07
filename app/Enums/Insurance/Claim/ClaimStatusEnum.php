<?php

namespace App\Enums\Insurance\Claim;

enum ClaimStatusEnum: string
{

    case EVALUATION = 'Em avaliação';
    case APPROVED   = 'Aprovado';
    case DENIED     = 'Negado';


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
