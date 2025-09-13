<?php

namespace App\Helpers;

class LoanCalculator
{
    public static function calculateInstallment($amount, $annualRate, $tenor)
    {
        $i = ($annualRate / 100) / 12;

        if ($amount > 0 && $tenor > 0) {
            $total_payable = $amount + ($amount * ($i * $tenor));
            $installment = $total_payable / $tenor;

            return round($installment, 2);
        }

        return 0;
    }
}
