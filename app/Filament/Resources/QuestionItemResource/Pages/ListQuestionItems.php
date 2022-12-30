<?php

namespace App\Filament\Resources\QuestionItemResource\Pages;

use App\Filament\Resources\QuestionItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionItems extends ListRecords
{
    protected static string $resource = QuestionItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
