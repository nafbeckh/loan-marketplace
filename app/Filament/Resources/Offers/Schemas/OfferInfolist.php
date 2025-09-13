<?php

namespace App\Filament\Resources\Offers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OfferInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lender.company_name'),
                TextEntry::make('amount')
                    ->label('Jumlah Pinjaman')
                    ->money('idr', locale: 'id'),
                TextEntry::make('interest_rate')
                    ->label('Bunga per bulan')
                    ->numeric()
                    ->suffix('%'),
                TextEntry::make('installment_amount')
                    ->label('Angsuran per bulan')
                    ->money('idr', locale: 'id'),
                TextEntry::make('tenor')
                    ->numeric()
                    ->suffix(' bulan'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
