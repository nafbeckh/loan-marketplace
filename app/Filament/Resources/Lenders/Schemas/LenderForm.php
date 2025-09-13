<?php

namespace App\Filament\Resources\Lenders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class LenderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')->required(),
                TextInput::make('balance')
                    ->mask(RawJs::make(<<<'JS'
                        $money($input, ',')
                    JS))
                    ->stripCharacters('.')
                    ->numeric()
                    ->autocomplete(false)
                    ->required()
            ]);
    }
}
