<?php

namespace App\Filament\Resources\Batches\Pages;

use App\Filament\Resources\Batches\BatcheResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBatche extends EditRecord
{
    protected static string $resource = BatcheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
