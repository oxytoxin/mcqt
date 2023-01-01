<?php

namespace App\Filament\Resources\SubcategoryResource\Pages;

use App\Filament\Resources\SubcategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubcategory extends EditRecord
{
    protected static string $resource = SubcategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
