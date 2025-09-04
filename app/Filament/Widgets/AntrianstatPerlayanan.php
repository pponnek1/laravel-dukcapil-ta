<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Antrianstore;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AntrianstatPerlayanan extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Antrian per Layanan';

    protected function getData(): array
    {
        $today = Carbon::today();

        $data = Antrianstore::with(['antrian:id,nama_layanan'])
            ->select('antrian_id', DB::raw('count(*) as total'))
            ->whereDate('tanggal', $today)
            ->groupBy('antrian_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->antrian->nama_layanan ?? 'Tidak Dikenal' => $item->total];
            });

        return [
            'datasets' => [
                [
                    'label' => 'Total Antrian',
                    'data' => $data->values()->toArray(),
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $data->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,
                        'precision' => 0,
                        'beginAtZero' => true,
                        'callback' => 'function(value) { return Number.isInteger(value) ? value : null; }',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => ['display' => false],
                'tooltip' => ['enabled' => true],
            ],
            'animation' => [
                'duration' => 1000,
                'easing' => 'easeOutQuart',
            ],
        ];
    }

    public function getDescription(): ?string
    {
        return 'Distribusi jumlah orang mengantri berdasarkan jenis antrian';
    }
}
