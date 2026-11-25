<?php

namespace App\Filament\Resources\Prescriptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PrescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order.payment.merchant_reference')
                    ->disabled(),
                TextInput::make('customer_id')
                    ->numeric(),
                TextInput::make('validated_by_id')
                    ->numeric(),
                TextInput::make('patient_full_name')
                    ->required(),
                TextInput::make('patient_age')
                    ->required()
                    ->numeric(),
                TextInput::make('doctor_name')
                    ->required(),
                TextInput::make('doctor_license')
                    ->required(),
                DatePicker::make('prescribed_at')
                    ->required(),
                DatePicker::make('expires_at')
                    ->required(),
                TextInput::make('scan_url')
                    ->url()
                    ->required(),
                TextInput::make('scan_hash')
                    ->required(),
                DateTimePicker::make('validated_at')
                    ->required(),
                DateTimePicker::make('rejected_at')
                    ->required(),
                Textarea::make('rejected_reason')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
