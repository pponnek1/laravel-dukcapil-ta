<?php

namespace App\Filament\Resources\PanggilAntrianResource\Widgets;

use Filament\Widgets\Widget;

class DeskripsiOverview extends Widget
{
    protected static string $view = 'filament.resources.panggil-antrian-resource.widgets.deskripsi-overview';
    public $record;

    public function mount($record): void
    {
        $this->record = $record;
    }

    protected function getViewData(): array
    {
        return [
            'record' => $this->record,
        ];
    }
}
