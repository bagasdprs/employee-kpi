<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerformanceEvaluationResource\Pages;
use App\Filament\Resources\PerformanceEvaluationResource\RelationManagers;
use App\Models\PerformanceEvaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerformanceEvaluationResource extends Resource
{
    protected static ?string $model = PerformanceEvaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('employee_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('evaluator_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('period_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('final_score')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('performance_level'),
                Forms\Components\Toggle::make('is_finalized')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('evaluator_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('period_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('final_score')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('performance_level'),
                Tables\Columns\IconColumn::make('is_finalized')
                    ->boolean(),
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
            'index' => Pages\ListPerformanceEvaluations::route('/'),
            'create' => Pages\CreatePerformanceEvaluation::route('/create'),
            'edit' => Pages\EditPerformanceEvaluation::route('/{record}/edit'),
        ];
    }
}
