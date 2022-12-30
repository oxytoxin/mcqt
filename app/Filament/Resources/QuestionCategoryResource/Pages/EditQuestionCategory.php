<?php

namespace App\Filament\Resources\QuestionCategoryResource\Pages;

use App\Filament\Resources\QuestionCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionCategory extends EditRecord
{
    protected static string $resource = QuestionCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
