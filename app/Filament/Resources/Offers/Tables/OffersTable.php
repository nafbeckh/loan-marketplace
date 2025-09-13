<?php

namespace App\Filament\Resources\Offers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OffersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lender.company_name')
                    ->label('Company Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Jumlah Pinjaman')
                    ->money('idr', locale: 'id')
                    ->sortable(),
                TextColumn::make('interest_rate')
                    ->label('Bunga Per Tahun')
                    ->numeric()
                    ->suffix('%')
                    ->sortable(),
                TextColumn::make('tenor')
                    ->numeric()
                    ->suffix(' bulan')
                    ->sortable(),
                TextColumn::make('installment_amount')
                    ->label('Angusran Per Bulan')
                    ->numeric()
                    ->money('idr', locale: 'id')
                    ->sortable(),
                TextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
