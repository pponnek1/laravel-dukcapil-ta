<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;


class TimeWidget extends Component
{
    public $time;
    public $date;



    // Metode untuk mengatur waktu dan tanggal pertama kali di zona waktu Jakarta
    public function mount()
    {
        Carbon::setLocale('id');

        // Menggunakan zona waktu Asia/Jakarta
        $this->time = now('Asia/Jakarta')->format('H:i:s');
        $this->date = Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y');
    }

    public function render()
    {
        return view('livewire.time-widget');
    }

    // Metode untuk memperbarui waktu dan tanggal dengan zona waktu Jakarta
    public function updateTime()
    {
        Carbon::setLocale('id');

        $this->time = now('Asia/Jakarta')->format('H:i:s');
        $this->date = Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y');
    }
}

