<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Models\Antrianstore;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\Action;

class LaporanResource extends Resource
{
    protected static ?string $model = Antrianstore::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $navigationLabel = 'Laporan';
    protected static ?string $navigationBadgeTooltip = 'Laporan Hari Ini';


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('tanggal', Carbon::today())->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getNavigationBadge() > 10 ? 'warning' : 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nomor_hp')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('antrian.nama_layanan')
                    ->label('Layanan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'success' => 'selesai',
                        'primary' => 'dilewati',
                        'gray' => 'daftar',
                        'warning' => 'dipanggil',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                SelectFilter::make('antrian_id')
                    ->label('Layanan')
                    ->relationship('antrian', 'nama_layanan')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status')
                    ->options([
                        'selesai' => 'Selesai',
                        'dilewati' => 'Dilewati',
                        'daftar' => 'Daftar',
                        'dipanggil' => 'Dipanggil',
                    ]),

                Tables\Filters\Filter::make('tanggal_range')
                    ->form([
                        DatePicker::make('from')
                            ->label('Dari')
                            ->displayFormat('j F Y')
                            ->native(false),

                        DatePicker::make('to')
                            ->label('Sampai')
                            ->displayFormat('j F Y')
                            ->native(false),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn (Builder $query, $date) => $query->whereDate('tanggal', '>=', $date))
                            ->when($data['to'], fn (Builder $query, $date) => $query->whereDate('tanggal', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators['from'] = 'Dari: ' . Carbon::parse($data['from'])->format('j F Y');
                        }

                        if ($data['to'] ?? null) {
                            $indicators['to'] = 'Sampai: ' . Carbon::parse($data['to'])->format('j F Y');
                        }

                        return $indicators;
                    }),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->headerActions([
                Action::make('export_excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (HasTable $livewire) {
                        $data = $livewire->getFilteredTableQuery()->with('antrian')->get();

                        return Excel::download(
                            new LaporanExport($data->toArray()),
                            'laporan-' . now()->format('Y-m-d_H-i') . '.xlsx'
                        );
                    }),

                    Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document')
                    ->color('danger')
                    ->url(fn (HasTable $livewire) => route('laporan.export-pdf', [
                        'antrian_id' => $livewire->filters['antrian_id'] ?? null,
                        'status' => $livewire->filters['status'] ?? null,
                        'from' => $livewire->filters['tanggal_range']['from'] ?? null,
                        'to' => $livewire->filters['tanggal_range']['to'] ?? null,
                    ]))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporans::route('/'),
        ];
    }

        public static function getPluralModelLabel(): string
    {
        return __('Laporan');
    }
}
