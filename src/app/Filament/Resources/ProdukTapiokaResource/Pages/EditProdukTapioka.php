<?php

namespace App\Filament\Resources\ProdukTapiokaResource\Pages;

use App\Filament\Resources\ProdukTapiokaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProdukTapioka extends EditRecord
{
    protected static string $resource = ProdukTapiokaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
