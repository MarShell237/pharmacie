<?php

namespace App\Filament\Resources\Prescriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Illuminate\Database\Eloquent\Builder;

class PrescriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultGroup('order.merchant_reference', direction: 'desc')
            ->columns([
                ImageColumn::make('scan_url')
                    ->label('image')
                    ->imageWidth(200),
                TextColumn::make('order.merchant_reference')
                    ->label('reference unique du paiement')
                    ->placeholder('commande non payer'),
                TextColumn::make('customer.email')
                    ->label('email du client')
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
                    ->date('l d F Y')
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->label('expire la')
                    ->date('l d F Y')
                    ->sortable(),
                // TextColumn::make('scan_hash')
                //     ->label('hash de l\'image')
                //     ->searchable(),
                TextColumn::make('validated_at')
                    ->label('valider le')
                    ->placeholder('pas encore valider')
                    ->dateTime('l d F Y à H:i:s')
                    ->sortable(),
                TextColumn::make('rejected_at')
                    ->label('rejeter le')
                    ->placeholder('rejeter le')
                    ->dateTime('l d F Y à H:i:s')
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
                // Filter::make('en_attente_livraison')
                //     ->label('En attente de livraison')
                //     ->query(fn (Builder $query) => $query->whereNotNull('order.paid_at')->whereNull('order.delivered_at'))
                //     ->default(),
                Filter::make('non_inspecter')
                    ->label('non inspecter')
                    ->query(fn (Builder $query) => $query->whereNull('validated_at')->whereNull('rejected_at'))
                    ->default()
            ])
            ->groups([
                Group::make('order.merchant_reference')
                    ->label('commande deja payer')
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
