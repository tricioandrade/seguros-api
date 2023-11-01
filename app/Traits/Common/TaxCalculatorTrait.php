<?php

namespace App\Traits\Common;

trait TaxCalculatorTrait
{
    /**
     * Calculate IVA
     *
     * @param int|float $value
     * @param int|float $percentage
     * @return object
     */
    public function calculateIVA(int|float $value, int|float $percentage): object
    {
        $taxToAdd       = $value * ($percentage / 100);
        $totalWithTax   = $taxToAdd + $value;

        return (object) [
            'percentage'    => $percentage,
            'total'         => $value,
            'totalWithTax'  => $totalWithTax,
            'taxAdded'      => $taxToAdd
        ];
    }

    /**
     * Calculate IS
     *
     * @param int|float $value
     * @param float|int $amount
     * @return object
     */
    public function calculateIS(int|float $value, float|int $amount): object
    {
        $totalWithTax   = $value * $amount;

        return (object) [
            'percentage'    => $amount,
            'taxAdded'      => $amount,
            'total'         => $value,
            'totalWithTax'  => $totalWithTax,
        ];
    }

    /**
     * Calculate NS
     *
     * @param $value
     * @return object
     */
    public function calculateNS($value): object
    {
        return (object) [
            'taxAdded'      => 0,
            'total'         => $value,
            'totalWithTax'  => $value,
        ];
    }
}
