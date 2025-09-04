<?php

namespace App\Filament\Widgets;

use App\Models\Antrianstore;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class AntrianHariIniTable extends BaseWidget
{
    protected static ?string $heading = 'Antrian Hari Ini';


    protected function getTableQuery(): Builder
    {
        return Antrianstore::with('antrian')
            ->whereDate('tanggal', Carbon::today())
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [

            Tables\Columns\TextColumn::make('index')->label('No.')->rowIndex(),

            Tables\Columns\TextColumn::make('kode')
                ->label('Kode Antrian')
                ->searchable(),

            Tables\Columns\TextColumn::make('nama_lengkap')
                ->label('Nama')
                ->searchable(),

            Tables\Columns\TextColumn::make('antrian.nama_layanan')
                ->label('Layanan'),

            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'daftar' => 'info',
                    'dipanggil' => 'info',
                    'selesai' => 'success',
                    default => 'gray',
                }),

            Tables\Columns\TextColumn::make('waktu_ambil')
                ->label('Waktu Ambil')
                ->dateTime('j F Y H:i')
                ->toggleable(isToggledHiddenByDefault: true)
                ->sortable(),
        ];
    }


    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

}
