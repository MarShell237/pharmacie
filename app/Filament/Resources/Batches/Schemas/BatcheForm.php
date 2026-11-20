<?php

namespace App\Filament\Resources\Batches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BatcheForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('batch_number')
                    ->required(),
                DatePicker::make('expiration_date')
                    ->required(),
                TextInput::make('quantity_receive')
                    ->required()
                    ->numeric(),
            ]);
    }
}
