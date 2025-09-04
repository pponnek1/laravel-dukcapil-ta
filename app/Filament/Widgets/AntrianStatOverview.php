<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Antrianstore;
use App\Models\Antrian;
use Filament\Widgets\StatsOverviewWidget\Card;
use Carbon\Carbon;

class AntrianStatOverview extends BaseWidget
{
    protected ?string $heading = 'Statistik Antrian Hari Ini';
    protected ?string $description = 'laporan singkat tentang antrian hari ini';


    protected function getCards(): array
    {
        $today = Carbon::today();

        return [
            Card::make('Total Antrian Hari Ini', Antrianstore::whereDate('tanggal', $today)->count())
                ->description('Jumlah orang yang mengambil antrian hari ini')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary')
                ->chart([12, 14, 11, 15, 17, 13, 18]),

            Card::make('Antrian Aktif', Antrian::count())
                ->description('Jumlah total antrian yang sedang berjalan')
                ->descriptionIcon('heroicon-o-clock')
                ->color('info')
                ->chart([10, 12, 8, 14, 16, 12, 15]),

            Card::make('Sudah Dilayani', Antrianstore::whereDate('tanggal', $today)->where('status', 'selesai')->count())
                ->description('Antrian yang telah selesai dilayani hari ini')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success')
                ->chart([5, 6, 7, 8, 9, 10, 12]),

            Card::make('Belum Dipanggil', Antrianstore::whereDate('tanggal', $today)->where('status', 'daftar')->count())
                ->description('Antrian yang masih menunggu giliran')
                ->descriptionIcon('heroicon-o-bell-alert')
                ->color('danger')
                ->chart([8, 7, 6, 9, 10, 7, 6]),
        ];
    }
}
