<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'order_items';

    protected static ?string $relatedResource = OrderResource::class;

    protected static ?string $title = 'Contenu du panier';

    public function table(Table $table): Table
    {
        // return $table
        //     ->headerActions([
        //         CreateAction::make(),
        //     ]);
        return $table
            ->defaultSort('quantity')
            ->paginated(false)
            ->columns([
                TextColumn::make('product.name')
                    ->label('nom du produit')
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('quantité')
                    ->numeric()
                    ->sortable()
                    ->summarize(
                        Sum::make()->label('Total Qté :')
                    ),
                TextColumn::make('product_price')
                    ->label('prix unitaire')
                    ->money('XAF')
                    ->state(fn($record) => $record->product->price),
                    // ->summarize([
                    //     Summarizer::make()
                    //         ->label('Réduction Coupon :')
                    //         ->using(function (Table $table) {
                    //             $order = $table->getRelationship()->getParent();
                    //             $discount = "0 %";
                    //             if(filled($order->coupon)){
                    //                 if(filled($order->coupon->discount_percentage)){
                    //                     $discount = floor($order->coupon->discount_percentage) . ' %';
                    //                 }else{
                    //                     $discount =  $order->coupon->discount_value . ' FCFA';
                    //                 }
                    //             }
                    //             return "- $discount"; 
                    //     }),
                    //     Summarizer::make()
                    //         ->label('Expédition :')
                    //         ->money('XAF')
                    //         ->using(function (Table $table) {
                    //             $order = $table->getRelationship()->getParent();
                    //             return $order->agency->delivery_fee; 
                    //     }),
                    // ]),
                TextColumn::make('total_price')
                    ->label('Prix total')
                    ->money('XAF')
                    ->state(function ($record): float|int {
                        $quantity = $record->quantity ?? 0;
                        $price = $record->product?->price ?? 0;

                        return $quantity * $price;
                    })
                    ->summarize([
                        Summarizer::make()
                            ->label('Montant Total :')
                            ->money('XAF')
                            ->using(function (Table $table) {
                                return $table->getRecords()->sum(function ($record) {
                                    return ($record->quantity ) * ($record->product?->price);
                                });
                        }),

                        // Summarizer::make()
                        //     ->label('Montant après reduction :')
                        //     ->money('XAF')
                        //     ->using(function (Table $table) {
                        //         $subtotal = $table->getRecords()->sum(function ($record) {
                        //             return ($record->quantity ) * ($record->product?->price);
                        //         });
                        //         $order = $table->getRelationship()->getParent();
                        //         $discount = 0;
                        //         if(filled($order->coupon)){
                        //             if($order->coupon->discount_percentage != null){
                        //                 $discount = floor($subtotal * ($order->coupon->discount_percentage / 100));
                        //             }else{
                        //                 $discount = $order->coupon->discount_value;
                        //             }        
                        //         }
                        //         return $subtotal - $discount;
                        // }),

                        // Summarizer::make()
                        //     ->label('Net à payer :')
                        //     ->money('XAF')
                        //     ->using(function (Table $table) {
                        //         $order = $table->getRelationship()->getParent();
                                
                        //         $subtotal = $table->getRecords()->sum(fn ($r) => $r->quantity * $r->product?->price);
                                
                        //         $discount = 0;
                        //         if(filled($order->coupon)){
                        //             if($order->coupon->discount_percentage != null){
                        //                 $discount = floor($subtotal * ($order->coupon->discount_percentage / 100));
                        //             }else{
                        //                 $discount = $order->coupon->discount_value;
                        //             }        
                        //         }
                        //         $shipping = $order->agency->delivery_fee;
                        //         return ($subtotal + $shipping) - $discount;
                        //     }),
                    ]),
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
                //
            ]);
    }
}
