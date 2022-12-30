<?php

namespace App\Filament\Resources\QuestionSourceResource\Pages;

use App\Filament\Resources\QuestionSourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionSource extends EditRecord
{
    protected static string $resource = QuestionSourceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
