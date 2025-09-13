<?php

namespace App\Filament\Resources\Offers\Pages;

use App\Filament\Resources\Offers\OfferResource;
use App\Helpers\LoanCalculator;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateOffer extends CreateRecord
{
    protected static string $resource = OfferResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['lender_id'] = Auth::user()->lender->id;

         $data['installment_amount'] = LoanCalculator::calculateInstallment(
            $data['amount'],
            $data['interest_rate'],
            $data['tenor']
        );

        return $data;
    }
}
