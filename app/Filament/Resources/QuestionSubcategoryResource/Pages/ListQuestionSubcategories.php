<?php

namespace App\Filament\Resources\QuestionSubcategoryResource\Pages;

use App\Filament\Resources\QuestionSubcategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionSubcategories extends ListRecords
{
    protected static string $resource = QuestionSubcategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
