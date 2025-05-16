<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CriteriaScoreResource\Pages;
use App\Filament\Resources\CriteriaScoreResource\RelationManagers;
use App\Models\CriteriaScore;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CriteriaScoreResource extends Resource
{
    protected static ?string $model = CriteriaScore::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('evaluation_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('criteria_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('comment')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('evaluation_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('criteria_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCriteriaScores::route('/'),
            'create' => Pages\CreateCriteriaScore::route('/create'),
            'edit' => Pages\EditCriteriaScore::route('/{record}/edit'),
        ];
    }
}
