<?php

namespace App\Filament\Resources\Lenders\Pages;

use App\Filament\Resources\Lenders\LenderResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLender extends EditRecord
{
    protected static string $resource = LenderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
