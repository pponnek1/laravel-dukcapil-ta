<?php

namespace App\Http\Controllers;
use App\Models\Antrian;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DaftarAntrianController extends Controller
{
    public function index()
    {

        $icons = [
            'bi-person-badge',
            'bi-house-door',
            'bi-journal-bookmark',
            'bi-card-checklist',
            'bi-award',
            'bi-archive',
            'bi-people',
            'bi-globe',
            'bi-file-earmark-text'
        ];

        // Ambil semua antrian
        $antrianList = Antrian::all();

        // Tambahkan icon secara random ke setiap item
        foreach ($antrianList as $item) {
            $item->icon = $icons[array_rand($icons)];
        }

        return view('frontend.list-antrian.index', [
            'antrianList' => $antrianList,
        ]);
    }

    public function show(Antrian $antrian)
    {
        $icons = [
            'bi-person-badge',
            'bi-house-door',
            'bi-journal-bookmark',
            'bi-card-checklist',
            'bi-award',
            'bi-archive',
            'bi-people',
            'bi-globe',
            'bi-file-earmark-text'
        ];

        $antrianList = Antrian::whereDate('created_at', Carbon::today())->get();

        foreach ($antrianList as $item) {
            $item->icon = $icons[array_rand($icons)];
        }


        return view('frontend.list-antrian.show', [
            'listPendaftar' => $antrian,
            'antrianList' => $antrianList,
        ]);
    }
}
