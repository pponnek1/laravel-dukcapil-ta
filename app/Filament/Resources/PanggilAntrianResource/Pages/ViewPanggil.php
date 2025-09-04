<?php

namespace App\Filament\Resources\PanggilAntrianResource\Pages;

use App\Filament\Resources\PanggilAntrianResource;
use App\Models\Antrianstore;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Resources\Components\Tab;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Widgets\TimeWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Carbon;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\IconPosition;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;

class ViewPanggil extends ViewRecord implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = PanggilAntrianResource::class;
    protected static string $view = 'filament.resources.panggil-antrian-resource.pages.panggil-antrian';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return Antrianstore::query()
                    ->where('antrian_id', $this->record->id)
                    ->orderBy('kode', 'asc');
            })
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex()
                    ->searchable(isIndividual: false)
                    ->sortable(),
                    // ->toggleable(),

                TextColumn::make('kode')
                    ->label('Nomor Antrian')
                    ->sortable()
                    ->searchable()
                    ->size('lg')
                    ->weight('bold')
                    ->color('primary')
                    ->description(fn ($record) => $record->antrian->nama_layanan),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Pendaftar')
                    ->searchable()
                    ->wrap()
                    ->copyable()
                    ->size('lg')
                    ->weight('bold')
                    ->icon('heroicon-o-user')
                    ->description(fn ($record) => 'HP: ' . $record->nomor_hp),

                TextColumn::make('alamat')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->alamat)
                    ->toggleable(),

                TextColumn::make('tanggal')
                    ->date('j F Y')
                    ->icon('heroicon-o-calendar')
                    ->tooltip(fn ($record) => 'Terdaftar: ' . $record->waktu_ambil->format('H:i'))
                    ->toggleable(),

                TextColumn::make('status_timeline')
                    ->label('Timeline')
                    ->html()
                    ->getStateUsing(function ($record) {
                        $html = '<div class="flex flex-col space-y-1 text-xs">';

                        if ($record->waktu_ambil) {
                            $html .= '<div class="flex items-center">
                                <span>Daftar  : ' . $record->waktu_ambil->format('H:i') . '</span>
                            </div>';
                        }

                        if ($record->dipanggil_pada) {
                            $html .= '<div class="flex items-center">
                                <span>Panggil : ' . Carbon::parse($record->dipanggil_pada)->format('H:i') . '</span>
                            </div>';
                        }

                        if ($record->selesai_pada) {
                            $html .= '<div class="flex items-center">
                                <span>Selesai : ' . Carbon::parse($record->selesai_pada)->format('H:i') . '</span>
                            </div>';
                        }

                        if ($record->dilewati_pada) {
                            $html .= '<div class="flex items-center">
                                <span>Dilewati : ' . Carbon::parse($record->dilewati_pada)->format('H:i') . '</span>
                            </div>';
                        }

                        $html .= '</div>';

                        return $html;
                    })
                    ->toggleable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'selesai',
                        'warning' => 'dilewati',
                        'gray' => 'daftar',
                        'info' => 'dipanggil',
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => 'selesai',
                        'heroicon-o-arrow-path' => 'dilewati',
                        'heroicon-o-clock' => 'daftar',
                        'heroicon-o-speaker-wave' => 'dipanggil',
                    ]),
            ])
            ->defaultSort('kode', 'asc')
            ->striped()
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_date')
                            ->label('Tanggal')
                            ->default(Carbon::today()),
                    ])
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_date']) {
                            return null;
                        }

                        return 'Tanggal: ' . Carbon::parse($data['created_date'])->format('j F Y');
                    })
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['created_date'], function ($query, $date) {
                                return $query->whereDate('created_at', $date);
                            });
                    }),

                SelectFilter::make('status')
                    ->options([
                        'daftar' => 'Terdaftar',
                        'dipanggil' => 'Sedang Dipanggil',
                        'selesai' => 'Selesai',
                        'dilewati' => 'Dilewati',
                    ])
                    ->multiple()
                    ->preload(),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filter')
                    ->icon('heroicon-o-funnel')
            )
            ->actions([
                Action::make('panggil')
                    ->label('Panggil')
                    ->icon('heroicon-o-speaker-wave')
                    ->iconPosition(IconPosition::Before)
                    ->color('info')
                    ->button()
                    ->size(ActionSize::Large)
                    ->visible(fn ($record) => $record->status !== 'selesai' && $record->status !== 'dipanggil')
                    ->action(function ($record) {
                        $this->callPanggilAntrian([
                            'id' => $record->id,
                            'nama' => $record->nama_lengkap,
                            'kode' => $record->kode,
                            'waktu' => $record->tanggal,
                        ]);

                        Notification::make()
                            ->title('Antrian berhasil dipanggil')
                            ->body('Nomor antrian ' . $record->kode . ' atas nama ' . $record->nama_lengkap)
                            ->success()
                            ->send();
                    })
                    ->extraAttributes(fn($record) => [
                        'type' => 'button',
                        'onclick' => "event.stopPropagation(); panggilAntrianButton(this);",
                        'data-role' => 'panggil-button',
                        'class' => 'btn btn-info',
                        'data-id' => $record->id,
                        'data-nama' => htmlspecialchars($record->nama_lengkap),
                        'data-kode' => htmlspecialchars($record->kode),
                        'data-waktu' => htmlspecialchars($record->tanggal),
                    ]),

                Action::make('panggil_ulang')
                    ->label('Panggil Ulang')
                    ->icon('heroicon-o-arrow-path')
                    ->iconPosition(IconPosition::Before)
                    ->color('info')
                    ->button()
                    ->size(ActionSize::Large)
                    ->visible(fn ($record) => $record->status === 'dipanggil')
                    ->extraAttributes(fn($record) => [
                        'type' => 'button',
                        'onclick' => "event.stopPropagation(); panggilAntrianButton(this);",
                        'data-role' => 'panggil-button',
                        'class' => 'btn btn-info',
                        'data-id' => $record->id,
                        'data-nama' => htmlspecialchars($record->nama_lengkap),
                        'data-kode' => htmlspecialchars($record->kode),
                        'data-waktu' => htmlspecialchars($record->tanggal),
                    ]),

                Action::make('skip')
                    ->label('Lewati')
                    ->icon('heroicon-o-arrow-right')
                    ->iconPosition(IconPosition::Before)
                    ->color('warning')
                    ->button()
                    ->size(ActionSize::Large)
                    ->visible(fn ($record) => $record->status !== 'selesai' && $record->status !== 'dilewati')
                    ->action(function($record) {
                        $this->handleSkip($record);

                        Notification::make()
                            ->title('Antrian dilewati')
                            ->body('Nomor antrian ' . $record->kode . ' telah dilewati')
                            ->warning()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Lewati Antrian')
                    ->modalDescription('Apakah Anda yakin ingin melewati antrian ini? Tindakan ini akan mengubah status antrian menjadi "dilewati".')
                    ->modalSubmitActionLabel('Ya, Lewati')
                    ->modalCancelActionLabel('Batal'),

                Action::make('selesai')
                    ->label('Selesai')
                    ->icon('heroicon-o-check')
                    ->iconPosition(IconPosition::Before)
                    ->color('success')
                    ->button()
                    ->size(ActionSize::Large)
                    ->visible(fn ($record) => $record->status !== 'selesai')
                    ->action(function($record) {
                        $this->handleSelesai($record);

                        Notification::make()
                            ->title('Antrian selesai')
                            ->body('Nomor antrian ' . $record->kode . ' telah selesai dilayani')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Selesaikan Antrian')
                    ->modalDescription('Apakah Anda yakin ingin menyelesaikan antrian ini? Tindakan ini akan mengubah status antrian menjadi "selesai".')
                    ->modalSubmitActionLabel('Ya, Selesaikan')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->emptyStateHeading('Belum ada antrian')
            ->emptyStateDescription('Antrian untuk layanan ini belum tersedia atau belum ada pendaftar.')
            ->emptyStateIcon('heroicon-o-queue-list')
            ->poll('30s');
    }


    protected function getListeners(): array
    {
        return [
            'panggilAntrian' => 'callPanggilAntrian',
            'refreshTable' => '$refresh',
        ];
    }

    public function callPanggilAntrian($data): void
    {
        $antrian = is_array($data) ? AntrianStore::find($data['id']) : AntrianStore::find($data->id);

        if ($antrian) {
            $antrian->dipanggil_pada = now();
            $antrian->update([
                'status' => 'dipanggil',
            ]);

            $antrian->save();

            $this->dispatch('refreshTable');
        }
    }

    public function handleSelesai($record): void
    {
        $antrian = AntrianStore::find($record->id);

        if ($antrian) {
            $antrian->selesai_pada = now();

            $antrian->update([
                'status' => 'selesai',
            ]);

            $antrian->save();
            $this->dispatch('refreshTable');
        }
    }

    public function handleSkip($record): void
    {
        $antrian = AntrianStore::find($record->id);

        if ($antrian) {
            $antrian->update([
                'dilewati_pada' => now(),
                'status' => 'dilewati',
            ]);

            $antrian->save();
            $this->dispatch('refreshTable');
        }
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TimeWidget::class,
        ];
    }

    protected function mutateHeaderWidgetsData(array $data): array
    {
        return array_merge($data, [
            'antrianId' => $this->record->id,
            'layananName' => $this->record->nama_layanan ?? 'Layanan Antrian',
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\Action::make('viewStats')
            //     ->label('Statistik Antrian')
            //     ->icon('heroicon-o-chart-bar')
            //     ->url(route('filament.admin.resources.antrian-stats.index', ['antrian' => $this->record->id]))
            //     ->color('success')
            //     ->button(),

            Actions\Action::make('refreshAntrian')
                ->label('Refresh Data')
                ->icon('heroicon-o-arrow-path')
                ->action(function() {
                    $this->dispatch('refreshTable');

                    Notification::make()
                        ->title('Data antrian diperbarui')
                        ->success()
                        ->send();
                })
                ->color('gray')
                ->button(),
        ];
    }

    public function getTitle(): string
    {
        return 'Manajemen Antrian: ' . ($this->record->nama_layanan ?? 'Layanan');
    }

    protected function getFooterWidgets(): array
    {
        return [
            // You can add summary widgets here if needed
        ];
    }
}
