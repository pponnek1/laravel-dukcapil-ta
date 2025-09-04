<?php

namespace App\Filament\Resources\PanggilAntrianResource\Pages;

use App\Filament\Resources\PanggilAntrianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPanggilAntrian extends EditRecord
{
    protected static string $resource = PanggilAntrianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
