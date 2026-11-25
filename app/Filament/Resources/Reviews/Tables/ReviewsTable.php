<?php

namespace App\Filament\Resources\Reviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email')
                    ->label('email du client')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rating')
                    ->label('note')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('content')
                    ->label('contenu')
                    ->searchable(),
                IconColumn::make('is_visible')
                    ->label('est visible ?')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('créé le')
                    ->dateTime('l d F Y à H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('mis à jour le')
                    ->dateTime('l d F Y à H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
