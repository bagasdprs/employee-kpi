<?php

namespace App\Filament\Resources\CriteriaScoreResource\Pages;

use App\Filament\Resources\CriteriaScoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCriteriaScores extends ListRecords
{
    protected static string $resource = CriteriaScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
