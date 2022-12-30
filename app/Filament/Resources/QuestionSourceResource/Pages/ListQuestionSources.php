<?php

namespace App\Filament\Resources\QuestionSourceResource\Pages;

use App\Filament\Resources\QuestionSourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionSources extends ListRecords
{
    protected static string $resource = QuestionSourceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
