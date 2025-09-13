<?php

namespace App\Filament\Resources\Lenders\Pages;

use App\Filament\Resources\Lenders\LenderResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLender extends CreateRecord
{
    protected static string $resource = LenderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
}
