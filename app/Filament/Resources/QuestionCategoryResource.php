<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\QuestionCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionCategoryResource\Pages;
use App\Filament\Resources\QuestionCategoryResource\RelationManagers;
use App\Filament\Resources\QuestionCategoryResource\Pages\EditQuestionCategory;
use App\Filament\Resources\QuestionCategoryResource\Pages\CreateQuestionCategory;
use App\Filament\Resources\QuestionCategoryResource\Pages\ListQuestionCategories;
use App\Filament\Resources\QuestionCategoryResource\RelationManagers\QuestionSubcategoriesRelationManager;

class QuestionCategoryResource extends Resource
{
    protected static ?string $model = QuestionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Question Sources and Groupings';


    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('question_source_id')
                    ->relationship('question_source', 'name')
                    ->label('Question Source')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question_source.name')
                    ->label('Question Source')
                    ->sortable(),
                TextColumn::make('name'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionSubcategoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestionCategories::route('/'),
            'create' => Pages\CreateQuestionCategory::route('/create'),
            'edit' => Pages\EditQuestionCategory::route('/{record}/edit'),
        ];
    }
}
