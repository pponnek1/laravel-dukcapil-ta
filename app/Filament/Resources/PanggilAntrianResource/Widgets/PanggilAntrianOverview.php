<?php

namespace App\Filament\Resources\PanggilAntrianResource\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Antrianstore;
use Carbon\Carbon;

class PanggilAntrianOverview extends StatsOverviewWidget
{
    public ?int $antrianId = null;

    protected ?string $heading = 'Statistik Antrian Hari Ini';

    protected function getCards(): array
    {
        $query = Antrianstore::whereDate('created_at', Carbon::today());

        if ($this->antrianId) {
            $query->where('antrian_id', $this->antrianId);
        }

        $statusCounts = $query
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return [

            Stat::make('Dipanggil', $statusCounts['dipanggil'] ?? 0)
                ->description('Antrian yang sedang dipanggil')
                ->color('warning'),

            // Card::make('Selesai', $statusCounts['selesai'] ?? 0)
            //     ->description('Antrian yang sudah selesai')
            //     ->color('success'),
        ];
    }
}
