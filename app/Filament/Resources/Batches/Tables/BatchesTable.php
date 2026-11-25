<?php

namespace App\Filament\Resources\Batches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BatchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('batch_number')
                    ->label('numéro de lot')
                    ->searchable(),
                TextColumn::make('expiration_date')
                    ->label('date d\'expriration')
                    ->date('l d F Y')
                    ->sortable(),
                TextColumn::make('quantity_receive')
                    ->label('quantité reçue')
                    ->numeric()
                    ->sortable(),
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
