<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AntrianStatOverview;
use App\Filament\Widgets\AntrianstatPerlayanan;
use App\Filament\Widgets\AntrianHariIniTable;
use Filament\Widgets\AccountWidget;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            AntrianStatOverview::class,
            AntrianstatPerlayanan::class,
            AntrianHariIniTable::class,

        ];
    }
}
