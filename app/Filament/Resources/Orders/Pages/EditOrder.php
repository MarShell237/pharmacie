<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use App\Models\Order;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
            Action::make('Prendre en charge')
                ->visible(fn(Order $record) => !filled($record->admin_id))
                ->color('success')
                ->requiresConfirmation()
                ->action(function(Order $record){
                    $record->update([
                        'admin_id' => auth()->user()->id,
                        'handle_at' => now()
                    ]);
                })
        ];
    }
}
