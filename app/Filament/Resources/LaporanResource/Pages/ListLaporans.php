<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ListLaporans extends ListRecords
{
    protected static string $resource = LaporanResource::class;
    protected static ?string $title = 'Laporan';

    public function getTabs(): array
    {
        $todayCount = $this->getResource()::getModel()::query()
            ->whereDate('tanggal', Carbon::today())
            ->count();

        $selesaiCount = $this->getResource()::getModel()::query()
            ->where('status', 'selesai')
            ->count();

        $daftarCount = $this->getResource()::getModel()::query()
            ->where('status', 'daftar')
            ->count();

        $dipanggilCount = $this->getResource()::getModel()::query()
            ->where('status', 'dipanggil')
            ->count();

        $dilewatiCount = $this->getResource()::getModel()::query()
            ->where('status', 'dilewati')
            ->count();

        return [
            'all' => Tab::make()
                ->label('Semua')
                ->badge($this->getResource()::getModel()::count()),

            'today' => Tab::make()
                ->label('Hari Ini')
                ->badge($todayCount)
                ->modifyQueryUsing(fn(Builder $query) => $query->whereDate('tanggal', Carbon::today())),

            'selesai' => Tab::make()
                ->badge($selesaiCount)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'selesai')),

            'dipanggil' => Tab::make()
                ->badge($dipanggilCount)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'dipanggil')),

            'daftar' => Tab::make()
                ->badge($daftarCount)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'daftar')),

            'dilewati' => Tab::make()
                ->badge($dilewatiCount)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'dilewati')),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'all';
    }
}
