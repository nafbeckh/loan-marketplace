<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offers = [
            [
                'lender_id'     => 1,
                'amount'        => 15000000,
                'interest_rate' => 8.75,
                'tenor'         => 12,
            ],
            [
                'lender_id'     => 1,
                'amount'        => 10000000,
                'interest_rate' => 7,
                'tenor'         => 6,
            ],
            [
                'lender_id'     => 1,
                'amount'        => 25000000,
                'interest_rate' => 9.5,
                'tenor'         => 24,
            ],
            [
                'lender_id'     => 2,
                'amount'        => 15000000,
                'interest_rate' => 7.25,
                'tenor'         => 12,
            ],
            [
                'lender_id'     => 2,
                'amount'        => 10000000,
                'interest_rate' => 7.25,
                'tenor'         => 6,
            ],
            [
                'lender_id'     => 2,
                'amount'        => 50000000,
                'interest_rate' => 10.0,
                'tenor'         => 36,
            ],
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }
    }
}
