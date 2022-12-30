<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionSourceResource\Pages;
use App\Filament\Resources\QuestionSourceResource\RelationManagers;
use App\Filament\Resources\QuestionSourceResource\RelationManagers\QuestionCategoriesRelationManager;
use App\Models\QuestionSource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionSourceResource extends Resource
{
    protected static ?string $model = QuestionSource::class;

    protected static ?string $navigationIcon = 'heroicon-o-cloud-download';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Question Sources and Groupings';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            QuestionCategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestionSources::route('/'),
            'create' => Pages\CreateQuestionSource::route('/create'),
            'edit' => Pages\EditQuestionSource::route('/{record}/edit'),
        ];
    }
}
