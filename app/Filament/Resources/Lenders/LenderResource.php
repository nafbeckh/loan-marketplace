<?php

namespace App\Filament\Resources\Lenders;

use App\Filament\Resources\Lenders\Pages\CreateLender;
use App\Filament\Resources\Lenders\Pages\EditLender;
use App\Filament\Resources\Lenders\Pages\ListLenders;
use App\Filament\Resources\Lenders\Pages\ViewLender;
use App\Filament\Resources\Lenders\Schemas\LenderForm;
use App\Filament\Resources\Lenders\Schemas\LenderInfolist;
use App\Filament\Resources\Lenders\Tables\LendersTable;
use App\Models\Lender;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LenderResource extends Resource
{
    protected static ?string $model = Lender::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    public static function form(Schema $schema): Schema
    {
        return LenderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LenderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LendersTable::configure($table);
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
            'index' => ListLenders::route('/'),
            'create' => CreateLender::route('/create'),
            'view' => ViewLender::route('/{record}'),
            'edit' => EditLender::route('/{record}/edit'),
        ];
    }
}
