<?php

namespace App\Filament\Resources\PanggilAntrianResource\Pages;

use App\Filament\Resources\PanggilAntrianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanggilAntrians extends ListRecords
{
    protected static string $resource = PanggilAntrianResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
