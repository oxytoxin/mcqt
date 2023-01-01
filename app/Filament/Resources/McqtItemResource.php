<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\McqtItem;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\McqtItemResource\Pages\EditMcqtItem;
use App\Filament\Resources\McqtItemResource\Pages\ListMcqtItems;
use App\Filament\Resources\McqtItemResource\Pages\CreateMcqtItem;

class McqtItemResource extends Resource
{
    protected static ?string $model = McqtItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Items';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('subcategory_id')
                    ->relationship('subcategory', 'name')
                    ->required(),
                RichEditor::make('question')
                    ->required()
                    ->maxLength(65535),
                KeyValue::make('choices')
                    ->required(),
                TextInput::make('answer')
                    ->required(),
                Textarea::make('explanation')
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
                        BadgeColumn::make('subcategory.name')->sortable(),
                        ViewColumn::make('question')->view('filament.columns.question-column')->searchable(),
                    ])
                ])
            ])
            ->filters([
                SelectFilter::make('subcategory_id')
                    ->relationship('subcategory', 'name')
                    ->label('Subcategory')
                    ->placeholder('All Subcategories')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMcqtItems::route('/'),
            'create' => CreateMcqtItem::route('/create'),
            'edit' => EditMcqtItem::route('/{record}/edit'),
        ];
    }
}
