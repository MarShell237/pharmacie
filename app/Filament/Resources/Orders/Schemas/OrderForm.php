<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('delivery_fee')
                    ->numeric(),
                TextInput::make('delivery_adress'),
                DateTimePicker::make('paid_at'),
                DateTimePicker::make('handle_at'),
                DateTimePicker::make('delivered_at'),
            ]);
    }
}
