<?php

namespace App\Filament\Resources\LoanApplications;

use App\Filament\Resources\LoanApplications\Pages\EditLoanApplication;
use App\Filament\Resources\LoanApplications\Pages\ListLoanApplications;
use App\Filament\Resources\LoanApplications\Pages\ViewLoanApplication;
use App\Filament\Resources\LoanApplications\Schemas\LoanApplicationForm;
use App\Filament\Resources\LoanApplications\Schemas\LoanApplicationInfolist;
use App\Filament\Resources\LoanApplications\Tables\LoanApplicationsTable;
use App\Models\LoanApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LoanApplicationResource extends Resource
{
    protected static ?string $model = LoanApplication::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('offer', function ($query) {
                $query->where('lender_id', Auth::id());
            });
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolderArrowDown;

    public static function infolist(Schema $schema): Schema
    {
        return LoanApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LoanApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLoanApplications::route('/'),
            'view' => ViewLoanApplication::route('/{record}'),
        ];
    }
}
