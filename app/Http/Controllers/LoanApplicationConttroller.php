<?php

namespace App\Http\Controllers;

use App\Helpers\LoanCalculator;
use App\Models\Offer;
use Illuminate\Http\Request;

class LoanApplicationConttroller extends Controller
{
    public function index()
    {
        return view('loan.form', ['title' => 'Ajukan Pinjaman']);
    }

    public function getOffers(Request $request)
    {
        $request->merge([
            'amount'    => preg_replace('/[^0-9]/', '', $request->amount),
            'dp_amount' => preg_replace('/[^0-9]/', '', $request->dp_amount),
        ]);

        $data = $request->validate([
            'amount'      => 'required|numeric',
            'dp_percent'  => 'required|numeric',
            'dp_amount'   => 'required|numeric',
            'tenor'       => 'required|numeric',
            'purpose'     => 'required|string',
        ]);

        $data['total_amount'] = $data['amount'] - $data['dp_amount'];

        $offers = Offer::where([
                        'amount' => $data['amount'],
                        'tenor' => $data['tenor'],
                    ])
                    ->with('lender')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $offers->map(function ($offer) use ($data) {
            $i = ($offer->interest_rate / 100) / 12;
            $total_payable = $data['total_amount'] + ($data['total_amount'] * ($i * $offer->tenor));
            $offer->installment = round($total_payable / $offer->tenor, 2);

            $offer->first_payment = $data['dp_amount'] + $offer->installment;

            return $offer;
        });

        return view('loan.form', [
            'title' => 'Ajukan Pinjaman',
            'offers' => $offers,
            'formData' => $data
        ]);
    }
}
