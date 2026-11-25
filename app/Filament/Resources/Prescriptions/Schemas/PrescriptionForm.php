<?php

namespace App\Filament\Resources\Prescriptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\ImageEntry;

class PrescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('scan_url')
                    ->getStateUsing(fn ($record) => $record->getFileUrl())
                    ->visible(fn ($record) => filled($record))
                    ->label('image d\'ordonnance'),
                // TextInput::make('scan_url')
                //     ->url()
                //     ->required(),
                TextEntry::make('order.merchant_reference')
                    ->label('reference unique du paiement')
                    ->placeholder('commande non payer')
                    ->size(TextSize::Large),
                TextEntry::make('customer.email')
                    ->label('email du client')
                    ->size(TextSize::Large),
                TextEntry::make('admin.email')
                    ->label('admin valideur')
                    ->placeholder('pas encore valider')
                    ->size(TextSize::Large),
                TextInput::make('patient_full_name')
                    ->label('nom complet du patient')
                    ->required(),
                TextInput::make('patient_age')
                    ->label('age du patient')
                    ->required()
                    ->numeric(),
                TextInput::make('doctor_name')
                    ->label('nom du docteur')
                    ->required(),
                TextInput::make('doctor_license')
                    ->label('license du docteur')
                    ->required(),
                DatePicker::make('prescribed_at')
                    ->label('prescrit le')
                    ->required(),
                DatePicker::make('expires_at')
                    ->label('expire la')
                    ->required(),
                // TextInput::make('scan_hash')
                //     ->required(),
                DateTimePicker::make('validated_at')
                    ->label('valider le')
                    ->disabled(),
                DateTimePicker::make('rejected_at')
                    ->label('rejeter le')
                    ->disabled(),
                Textarea::make('rejected_reason')
                    ->label('raison du rejet')
                    ->disabled(fn($record) => filled($record->validated_by_id))
                    // ->required()
                    ->columnSpanFull(),
            ]);
    }
}
