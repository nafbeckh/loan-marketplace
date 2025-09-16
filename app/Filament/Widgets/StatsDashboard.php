<?php

namespace App\Filament\Widgets;

use App\Models\Lender;
use App\Models\LoanApplication;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        $lender = $user->lender ?? null;

        $balance = $lender?->balance ?? Lender::sum('balance');

        $approved = LoanApplication::whereHas('offer', function ($query) use ($lender) {
                        $query->where('lender_id', $lender->id);
                    })->where('status', 'approved')->count();
        $rejected = LoanApplication::whereHas('offer', function ($query) use ($lender) {
                        $query->where('lender_id', $lender->id);
                    })->
                    where('status', 'rejected')->count();

        return [
            Stat::make('Balance', 'Rp ' . number_format($balance, 0, ',', '.'))
                ->color('success'),
            Stat::make('Loan Approved', $approved)
                ->color('primary'),
            Stat::make('Loan Rejected', $rejected)
                ->color('danger'),
        ];
    }
}
