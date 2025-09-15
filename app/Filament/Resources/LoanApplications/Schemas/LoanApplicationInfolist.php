<?php

namespace App\Filament\Resources\LoanApplications\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LoanApplicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('borrower.name')
                    ->label('Peminjam'),
                TextEntry::make('offer.amount')
                    ->label('Jumlah Pinjaman')
                    ->numeric()
                    ->money('idr', locale: 'id'),
                TextEntry::make('dp_amount')
                    ->label('Angsuran Per Bulan')
                    ->numeric()
                    ->money('idr', locale: 'id'),
                TextEntry::make('installment_amount')
                    ->label('Angsuran Per Bulan')
                    ->numeric()
                    ->money('idr', locale: 'id'),
                TextEntry::make('offer.tenor')
                    ->label('Tenor')
                    ->suffix(' bulan'),
                TextEntry::make('purpose')
                    ->label('Tujuan'),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
