<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $append = ['installment_amount'];

    protected $guarded = [];

    public function getInstallmentAmountAttribute()
    {
        $i = ($this->interest_rate / 100) / 12;

        if ($this->amount > 0 && $this->tenor > 0) {
            $total_payable = $this->amount + ($this->amount * ($i * $this->tenor));
            $installment = $total_payable / $this->tenor;

            return round($installment, 2);
        }

        return 0;
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
