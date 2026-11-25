<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.email')
                    ->label('email du client'),
                TextInput::make('rating')
                    ->disabled()
                    ->label('note')
                    ->required()
                    ->numeric(),
                TextInput::make('content')
                    ->disabled()
                    ->label('contenu')
                    ->required(),
                Toggle::make('is_visible')
                    ->label('est visible ?')
                    ->required(),
            ]);
    }
}
