<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class FilterTanggalWidget extends Widget implements HasForms
{
    use InteractsWithForms;
    protected static string $view = 'filament.widgets.filter-tanggal-widget';

    public ?string $selectedDate = null;

    // Schema form untuk DatePicker
    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('selectedDate')
                ->label('Tanggal')
                ->default(now()->toDateString())
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->dispatch('tanggalUpdated', tanggal: $state)),
        ];
    }

    public function mount(): void
    {
        // Isi form saat widget dimuat
        $this->form->fill();
    }

    // Fungsi untuk set tanggal ke hari ini
    public function setTanggal(): void
    {
        // Set tanggal ke hari ini
        $this->selectedDate = now()->toDateString();
        $this->form->fill(); // Isi ulang form dengan tanggal yang baru
    }
}
