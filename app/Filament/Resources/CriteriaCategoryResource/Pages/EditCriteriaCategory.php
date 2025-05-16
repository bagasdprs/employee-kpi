<?php

namespace App\Filament\Resources\CriteriaCategoryResource\Pages;

use App\Filament\Resources\CriteriaCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCriteriaCategory extends EditRecord
{
    protected static string $resource = CriteriaCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
