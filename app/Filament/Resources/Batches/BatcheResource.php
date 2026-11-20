<?php

namespace App\Filament\Resources\Batches;

use App\Filament\Resources\Batches\Pages\CreateBatche;
use App\Filament\Resources\Batches\Pages\EditBatche;
use App\Filament\Resources\Batches\Pages\ListBatches;
use App\Filament\Resources\Batches\Schemas\BatcheForm;
use App\Filament\Resources\Batches\Tables\BatchesTable;
use App\Models\Batche;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BatcheResource extends Resource
{
    protected static ?string $model = Batche::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getModelLabel(): string
    {
        return 'lot';
    }

    public static function getPluralModelLabel(): string
    {
        return 'lots';
    }
    public static function getNavigationBadge(): ?string
    {
        return (string) Batche::query()->count();
    }

    protected static ?string $recordTitleAttribute = 'batch_number';

    public static function form(Schema $schema): Schema
    {
        return BatcheForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BatchesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBatches::route('/'),
            'create' => CreateBatche::route('/create'),
            'edit' => EditBatche::route('/{record}/edit'),
        ];
    }
}
