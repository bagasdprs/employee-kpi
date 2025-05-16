<?php

namespace App\Filament\Resources\CriteriaScoreResource\Pages;

use App\Filament\Resources\CriteriaScoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCriteriaScore extends EditRecord
{
    protected static string $resource = CriteriaScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
