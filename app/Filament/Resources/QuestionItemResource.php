<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionItemResource\Pages;
use App\Filament\Resources\QuestionItemResource\RelationManagers;
use App\Models\QuestionItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionItemResource extends Resource
{
    protected static ?string $model = QuestionItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Questions';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('question_subcategory_id')
                    ->relationship('question_subcategory', 'name')
                    ->required(),
                Forms\Components\RichEditor::make('question')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\KeyValue::make('choices')
                    ->required(),
                Forms\Components\TextInput::make('answer')
                    ->required(),
                Forms\Components\Textarea::make('explanation')
                    ->maxLength(65535),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Tables\Columns\BadgeColumn::make('question_subcategory.name')->sortable(),
                        Tables\Columns\ViewColumn::make('question')->view('filament.columns.question-column')->searchable(),
                    ])
                ])
            ])
            ->filters([
                SelectFilter::make('question_subcategory_id')
                    ->relationship('question_subcategory', 'name')
                    ->label('Question Subcategory')
                    ->placeholder('All Subcategories')
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
            'index' => Pages\ListQuestionItems::route('/'),
            'create' => Pages\CreateQuestionItem::route('/create'),
            'edit' => Pages\EditQuestionItem::route('/{record}/edit'),
        ];
    }
}
