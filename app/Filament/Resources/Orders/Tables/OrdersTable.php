<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('payment.merchant_reference')
                    ->label('reference unique du paiement')
                    ->placeholder('commande non payer'),
                TextColumn::make('user.email')
                    ->label('email du client')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('delivery_fee')
                    ->label('frais de livraison')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('delivery_adress')
                    ->label('adresse de livraison')
                    ->searchable(),
                TextColumn::make('paid_at')
                    ->label('payé à')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('handle_at')
                    ->label('pris en charge à')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('delivered_at')
                    ->label('livrer à')
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
                Filter::make('en_attente_livraison')
                    ->label('En attente de livraison')
                    ->query(fn (Builder $query) => $query->whereNotNull('paid_at')->whereNull('delivered_at'))
                    ->default(),

                Filter::make('non_pris_en_charge')
                    ->label('Non pris en charge')
                    ->query(fn (Builder $query) => $query->whereNull('handled_at')),

                    Filter::make('non_payees')
                    ->label('Non payées')
                    ->query(fn (Builder $query) => $query->whereNull('paid_at')),

                Filter::make('deja_livrees')
                    ->label('Déjà livrées')
                    ->query(fn (Builder $query) => $query->whereNotNull('delivered_at')),

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
