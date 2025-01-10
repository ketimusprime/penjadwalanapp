<?php

namespace App\Filament\Resources\SubKategoriResource\Pages;

use App\Filament\Resources\SubKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubKategori extends EditRecord
{
    protected static string $resource = SubKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
