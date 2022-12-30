<?php

namespace App\Filament\Resources\QuestionSubcategoryResource\Pages;

use App\Filament\Resources\QuestionSubcategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionSubcategory extends EditRecord
{
    protected static string $resource = QuestionSubcategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
