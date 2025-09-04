<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Antrianstore;

class AntrianStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Antrian Hari Ini', Antrianstore::whereDate('tanggal', today())->count()),
            Stat::make('Belum Dipanggil', Antrianstore::whereDate('tanggal', today())->whereNull('dipanggil_pada')->count()),
            Stat::make('Sedang Dipanggil', Antrianstore::whereDate('tanggal', today())->whereNotNull('dipanggil_pada')->whereNull('selesai_pada')->count()),
            Stat::make('Sudah Selesai', Antrianstore::whereDate('tanggal', today())->whereNotNull('selesai_pada')->count()),
        ];
    }
}
