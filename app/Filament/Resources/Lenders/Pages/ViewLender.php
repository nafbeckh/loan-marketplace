<?php

namespace App\Filament\Resources\Lenders\Pages;

use App\Filament\Resources\Lenders\LenderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLender extends ViewRecord
{
    protected static string $resource = LenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
