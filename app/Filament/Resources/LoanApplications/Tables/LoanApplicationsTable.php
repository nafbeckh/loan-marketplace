<?php

namespace App\Filament\Resources\LoanApplications\Tables;

use App\Models\LoanApplication;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoanApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('borrowed.name')
                    ->label('Peminjam')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('offer.lender.company_name')
                    ->label('Pemberi Pinjaman')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('offer.amount')
                    ->label('Jumlah Pinjaman')
                    ->numeric()
                    ->money('idr', locale: 'id')
                    ->sortable(),
                TextColumn::make('offer.installment_amount')
                    ->label('Angsuran Per Bulan')
                    ->numeric()
                    ->money('idr', locale: 'id')
                    ->sortable(),
                TextColumn::make('offer.tenor')
                    ->label('Tenor')
                    ->suffix(' bulan')
                    ->searchable(),
                TextColumn::make('purpose')
                    ->label('Tujuan')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ]),
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
                Action::make('updateStatus')
                    ->label('Update')
                    ->modalHeading('Update Status Pengajuan')
                    ->modalWidth('sm')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                    ])
                    ->action(function (LoanApplication $record, array $data) {
                        if ($data['status'] === 'approved') {
                            $lender = $record->offer->lender;

                            if ($lender->balance < $record->offer->amount) {
                                Notification::make()
                                    ->title('Saldo lender tidak mencukupi')
                                    ->danger()
                                    ->send();

                                return;
                            }

                            $lender->balance -= $record->offer->amount;
                            $lender->save();

                            $record->update([
                                'status' => 'approved',
                            ]);

                            Notification::make()
                                ->title('Pengajuan berhasil disetujui')
                                ->success()
                                ->send();
                        } elseif ($data['status'] === 'rejected') {
                            $record->update([
                                'status' => 'rejected',
                            ]);

                            Notification::make()
                                ->title('Pengajuan berhasil ditolak')
                                ->warning()
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
               //
            ]);
    }
}
