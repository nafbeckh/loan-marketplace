<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $appends = ['installment_amount', 'first_payment'];

    protected $guarded = [];

    public function getInstallmentAmountAttribute()
    {
        if (!$this->offer) {
            return 0;
        }

        $amountAfterDp = $this->offer->amount - ($this->dp_amount ?? 0);

        return Offer::calculateInstallment(
            $amountAfterDp,
            $this->offer->tenor,
            $this->offer->interest_rate
        );
    }

    public function getFirstPaymentAttribute()
    {
        return $this->installment_amount +$this->dp_amount;
    }

    public function borrower()
    {
        return $this->belongsTo(User::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
