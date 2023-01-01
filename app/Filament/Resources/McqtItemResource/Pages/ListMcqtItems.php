<?php

namespace App\Filament\Resources\McqtItemResource\Pages;

use App\Filament\Resources\McqtItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMcqtItems extends ListRecords
{
    protected static string $resource = McqtItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
