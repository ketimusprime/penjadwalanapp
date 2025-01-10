<?php

namespace App\Filament\Resources\SubKategoriResource\Pages;

use App\Filament\Resources\SubKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubKategoris extends ListRecords
{
    protected static string $resource = SubKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
