<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('nom')
                    ->required(),
                TextInput::make('email')
                    ->label('addresse email')
                    ->email()
                    ->unique()
                    ->required(),
                TextInput::make('phone')
                    ->label('numéro de téléphone')
                    ->unique()
                    ->required(),
                TextInput::make('registration_number')
                    ->label('matricule'),
                TextInput::make('password')
                    ->disabled()
                    ->password()
                    ->dehydrated()
                    ->default(fn () => Hash::make(Str::random(32)))
            ]);
    }
}
