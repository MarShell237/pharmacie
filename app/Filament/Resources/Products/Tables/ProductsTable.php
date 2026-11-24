<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->placeholder('pas d\'image')
                    ->disk('local')
                    ->getStateUsing(fn ($record) => $record?->getFileUrl()),
                TextColumn::make('category.name')
                    ->label('categorie')
                    ->sortable(),
                // TextColumn::make('image')
                //     ->label('image2')
                //     ->getStateUsing(fn ($record) => $record?->getFileUrl())
                //     ->sortable(),
                TextColumn::make('batche.batch_number')
                    ->label('numeros de lot')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('nom')
                    ->searchable(),
                // TextColumn::make('slug')
                //     ->searchable(),
                TextColumn::make('price')
                    ->label('prix')
                    ->sortable(),
                TextColumn::make('stock_quantity')
                    ->label('quantite en stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('low_stock_threshold')
                    ->label('seuil d\'alerte')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dosage')
                    ->label('dosage')
                    ->searchable(),
                TextColumn::make('inn')
                    ->label('dci')
                    ->searchable(),
                IconColumn::make('is_prescription_required')
                    ->label('est ce que une prescription est requise ?')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->label('publier le')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('mis à jour le')
                    ->dateTime()
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
