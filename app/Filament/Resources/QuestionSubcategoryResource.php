<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionSubcategoryResource\Pages;
use App\Filament\Resources\QuestionSubcategoryResource\RelationManagers;
use App\Models\QuestionSubcategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionSubcategoryResource extends Resource
{
    protected static ?string $model = QuestionSubcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-color-swatch';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Question Sources and Groupings';


    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_category_id')
                    ->relationship('question_category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question_category.name')
                    ->label('Question Category'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestionSubcategories::route('/'),
            'create' => Pages\CreateQuestionSubcategory::route('/create'),
            'edit' => Pages\EditQuestionSubcategory::route('/{record}/edit'),
        ];
    }
}
