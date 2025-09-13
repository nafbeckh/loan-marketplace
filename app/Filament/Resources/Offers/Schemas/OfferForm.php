<?php

namespace App\Filament\Resources\Offers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class OfferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->label('Jumlah Pinjaman')
                    ->mask(RawJs::make(<<<'JS'
                        $money($input, ',')
                    JS))
                    ->stripCharacters('.')
                    ->numeric()
                    ->autocomplete(false)
                    ->required(),
                TextInput::make('interest_rate')
                    ->label('Bunga per tahun (%)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01)
                    ->suffix('%')
                    ->required(),
                TextInput::make('tenor')
                    ->numeric()
                    ->minValue(1)
                    ->suffix(' bulan')
                    ->required(),
            ]);
    }
}
