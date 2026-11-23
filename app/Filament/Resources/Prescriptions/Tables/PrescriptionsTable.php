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
                    ->searchable(),
                TextColumn::make('patient_age')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('doctor_name')
                    ->searchable(),
                TextColumn::make('doctor_license')
                    ->searchable(),
                TextColumn::make('prescribed_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->date()
                    ->sortable(),
                TextColumn::make('scan_hash')
                    ->searchable(),
                TextColumn::make('validated_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('rejected_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter::make('en_attente_livraison')
                //     ->label('En attente de livraison')
                //     ->query(fn (Builder $query) => $query->whereNotNull('order.paid_at')->whereNull('order.delivered_at'))
                //     ->default(),
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
