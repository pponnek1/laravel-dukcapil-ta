<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Filament\Widgets\Widget;
use Livewire\WithPagination;

class DatePickerWidget extends Widget
{
    use WithPagination;

    protected static string $view = 'filament.widgets.date-picker-widget';

    public ?string $selectedDate = null;

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('selectedDate')
                ->label('Pilih Tanggal')
                ->default(today())
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) => $this->updateDate($state)),
        ];
    }

    public function updateDate($date)
    {
        $this->selectedDate = $date;
        $this->emit('filterTable', $date);  // Emit event untuk memfilter tabel berdasarkan tanggal
    }

    // public function render()
    // {
    //     return view(static::$view);
    // }
}
