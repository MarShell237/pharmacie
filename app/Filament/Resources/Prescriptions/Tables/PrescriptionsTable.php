<?php

namespace App\Filament\Resources\Prescriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PrescriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('scan_url')
                    ->label('image'),
                TextColumn::make('order.payment.merchant_reference')
                    ->label('reference unique du paiement')
                    ->placeholder('commande non payer'),
                TextColumn::make('customer.email')
                    ->label('email du client')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('admin.name')
                    ->label('admin valideur')
                    ->placeholder('pas encore valider')
                    ->sortable(),
                TextColumn::make('patient_full_name')
                    ->label('nom complet du patient')
                    ->searchable(),
                TextColumn::make('patient_age')
                    ->label('age du patient')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('doctor_name')
                    ->label('nom du docteur')
                    ->searchable(),
                TextColumn::make('doctor_license')
                    ->label('license du docteur')
                    ->searchable(),
                TextColumn::make('prescribed_at')
                    ->label('prescrit le')
                    ->date()
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->label('expire la')
                    ->date()
                    ->sortable(),
                // TextColumn::make('scan_hash')
                //     ->label('hash de l\'image')
                //     ->searchable(),
                TextColumn::make('validated_at')
                    ->label('valider le')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('rejected_at')
                    ->label('rejeter le')
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
                // Filter::make('en_attente_livraison')
                //     ->label('En attente de livraison')
                //     ->query(fn (Builder $query) => $query->whereNotNull('order.paid_at')->whereNull('order.delivered_at'))
                //     ->default(),
                Filter::make('deja inspecter')
                    ->label()
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
