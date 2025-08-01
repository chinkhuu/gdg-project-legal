<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttorneyResource\Pages;
use App\Filament\Resources\AttorneyResource\RelationManagers;
use App\Models\Attorney;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class AttorneyResource extends Resource
{
    protected static ?string $model = Attorney::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('segment_id')
                    ->label('Сигмент')
                    ->relationship('segment', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('profile')
                    ->maxSize(2048)
                    ->image(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(static fn(null|string $state):
                    null|string =>
                    filled($state) ? Hash::make($state):null,
                    )->required(static fn (Page $livewire): string=>
                        $livewire instanceof Pages\CreateAttorney,)
                    ->dehydrated(static fn(null|string $state): bool =>
                    filled($state),
                    )->label(static fn(Page $livewire): string =>
                    ($livewire instanceof Pages\EditAttorney) ? 'New Password' : 'Password'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('segment.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAttorneys::route('/'),
            'create' => Pages\CreateAttorney::route('/create'),
            'edit' => Pages\EditAttorney::route('/{record}/edit'),
        ];
    }
}
