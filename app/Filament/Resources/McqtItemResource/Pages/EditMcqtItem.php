<?php

namespace App\Filament\Resources\McqtItemResource\Pages;

use App\Filament\Resources\McqtItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMcqtItem extends EditRecord
{
    protected static string $resource = McqtItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
