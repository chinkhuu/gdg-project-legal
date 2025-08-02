<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('text')
                        ->label('Асуулт')
                        ->required()
                        ->maxLength(65535),
                    Forms\Components\Repeater::make('answers')
                        ->label('Хариултууд')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('text')
                                ->label('Хариулт')
                                ->required(),
                            Forms\Components\Toggle::make('is_correct')
                                ->label('Зөв эсэх')
                                ->inline(false),
                        ])
                        ->minItems(2)
                        ->defaultItems(4)
                        ->collapsible(),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('text')
            ->columns([
                Tables\Columns\TextColumn::make('text')->limit(50)->wrap(),
                Tables\Columns\TextColumn::make('answers_count')
                    ->counts('answers')
                    ->label('Хариулт тоо'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
