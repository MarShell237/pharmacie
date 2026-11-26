<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;


class OrderForm
{
    // public static function configure(Schema $schema): Schema
    // {
    //     return $schema
    //         ->components([
    //             TextInput::make('user_id')
    //                 ->required()
    //                 ->numeric(),
    //             TextInput::make('delivery_fee')
    //                 ->numeric(),
    //             TextInput::make('delivery_adress'),
    //             DateTimePicker::make('paid_at'),
    //             DateTimePicker::make('handle_at'),
    //             DateTimePicker::make('delivered_at'),
    //         ]);
    // }

        public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Informations de la commande")
                    ->columnSpanFull()
                    ->schema(static::getOrderInformations())
                    ->footer([
                        TextEntry::make('admin.email')
                            ->label('pris en charge par')
                            ->color('success')
                            ->size(TextSize::Large)
                    ]),
                // Section::make("Informations de livraison")
                //     ->schema(static::getDeliveryInputs())
                //     ->visible(fn(Order $record) => !filled($record->delivered_at))
                //     ->columnSpanFull()
            ]);
    }

    public static function getOrderInformations(){
        return [
            Group::make()
            ->schema([
                TextEntry::make('user.email')
                    ->label('email du client')
                    ->color('info')
                    ->size(TextSize::Large),
                // TextEntry::make('agency_id')
                //     ->label("nom de l'agence")
                //     ->getStateUsing(function($record){
                //         return $record->agency->name . ', ' . $record->agency->city->name;
                //     })
                //     ->color('info')
                //     ->size(TextSize::Large),
                TextEntry::make('paid_at')
                    ->label('payer le')
                    ->dateTime('l d F Y à H:i:s')
                    ->color('info')
                    ->size(TextSize::Large),
            ])->columns(),
            // Group::make()
            // ->schema([
            //     // TextEntry::make('coupon_code')
            //     //     ->label('code du coupon')
            //     //     ->placeholder('pas de coupon de reduction')
            //     //     ->color('info')
            //     //     ->size(TextSize::Large),
            // ])->columns(),
            // Group::make()
            // ->schema([
            
            // ])->columns(),
            Group::make()
            ->schema([
                TextEntry::make('handled_at')
                    ->label('pris en charge le')
                    ->placeholder('pas encore pris en charge')
                    ->dateTime('l d F Y à H:i:s')
                    ->color('info')
                    ->size(TextSize::Large),
                TextEntry::make('delivered_at')
                    ->placeholder('pas encore livrer')
                    ->label('livrer le')
                    ->dateTime('l d F Y à H:i:s')
                    ->color('info')
                    ->size(TextSize::Large),
            ])->columns(),
            TextEntry::make('created_at')
                ->label('créé le')
                ->dateTime('l d F Y à H:i:s')
                ->color('info')
                ->size(TextSize::Large),
            // Group::make()
            // ->schema([
            //     ImageEntry::make('parcel_image')
            //         ->getStateUsing(fn ($record) => $record->getFileUrl('parcel_image'))
            //         ->label('image du colis')
            //         ->placeholder('Pas d\'image du colis existant'),
            //     ImageEntry::make('receipt_image')
            //         ->getStateUsing(fn ($record) => $record->getFileUrl('receipt_image'))
            //         ->label('image du reçu')
            //         ->placeholder('Pas d\'image du reçu existant'),
            // ])->columns()
        ];
    }
}
