<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AntrianStore;

class DatePickerComponent extends Component
{

    public $selectedDate;
    public $filterDate = null;

    protected $listeners = ['applyDateFilter' => 'filterDataByDate'];

    public function mount()
    {
        $this->selectedDate = now()->toDateString(); // Default date
    }

    public function applyDate()
    {
        // Emit event untuk memfilter data berdasarkan tanggal
        $this->emit('filterByDate', $this->selectedDate);
    }

    public function filterDataByDate($date)
    {
        $this->filterDate = $date;
    }
    public function render()
    {
        return view('livewire.date-picker-component');
    }
}
