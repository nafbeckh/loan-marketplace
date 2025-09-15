<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $appends = ['installment_amount'];

    protected $guarded = [];

    public static function calculateInstallment($amount, $tenor, $interestRate)
    {
        $i = ($interestRate / 100) / 12;

        if ($amount > 0 && $tenor > 0) {
            $totalPayable = $amount + ($amount * ($i * $tenor));
            $installment = $totalPayable / $tenor;
            return round($installment, 2);
        }

        return 0;
    }

    public function getInstallmentAmountAttribute()
    {
        return $this->calculateInstallment($this->amount, $this->tenor, $this->interest_rate);
    }

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }

    public function loan_applications()
    {
        return $this->hasMany(LoanApplication::class);
    }
}
