<?php

namespace App\Http\Controllers;
use App\Models\Antrian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Antrian $antrian)
    {
        $kode = $antrian->kode;

        // Daftar icon
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

        return view('frontend.index', [
            'antrianList' => $antrianList,
            'antrians' => $antrian,
            'kode' => $kode,
        ]);
    }



    public function contact()
    {
        $antrianList = Antrian::all();
        return view('frontend.contact',[
            'antrianList' => $antrianList,
        ]);
    }
}
