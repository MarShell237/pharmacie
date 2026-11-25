<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('category_id')
                //     ->label('categorie')
                //     ->required()
                //     ->numeric(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('slug')
                    ->label('permalien')
                    ->disabled()
                    ->dehydrated(),
                Select::make('category_id')
                    ->label('categorie')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->dehydrated(),                
                Select::make('batche_id')
                    ->label('lot')
                    ->relationship('batche', 'batch_number')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->dehydrated(),
                TextInput::make('name')
                    ->label('nom')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                        })
                    ->unique()
                    ->required(),
                TextInput::make('price')
                    ->label('prix')
                    ->required()
                    ->numeric()
                    ->prefix('FCFA'),
                TextInput::make('stock_quantity')
                    ->label('quantite en stock')
                    ->required()
                    ->numeric(),
                TextInput::make('low_stock_threshold')
                    ->label('seuil d\'alerte')
                    ->required()
                    ->numeric(),
                TextInput::make('dosage')
                    ->label('dosage')
                    ->required(),
                TextInput::make('inn')
                    ->label('dci')
                    ->required(),
                Toggle::make('is_prescription_required')
                    ->label('est ce que une prescription est requise ?')
                    ->required(),
                Textarea::make('description')
                    ->label('description')
                    ->required()
                    ->columnSpanFull(),
                // DateTimePicker::make('published_at'),
            ]);
    }
}
