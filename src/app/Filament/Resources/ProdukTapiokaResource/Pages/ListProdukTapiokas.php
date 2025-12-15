<?php

namespace App\Filament\Resources\ProdukTapiokaResource\Pages;

use App\Filament\Resources\ProdukTapiokaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProdukTapiokas extends ListRecords
{
    protected static string $resource = ProdukTapiokaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
