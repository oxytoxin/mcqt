<?php

namespace App\Filament\Resources\QuestionItemResource\Pages;

use App\Filament\Resources\QuestionItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionItem extends EditRecord
{
    protected static string $resource = QuestionItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
