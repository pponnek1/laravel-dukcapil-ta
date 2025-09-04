<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\Antrianstore;

class testController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view('frontend.antrian.index', [
            'antrianList' => $antrianList,
            'antrians' => $antrian,
            'kode' => $kode,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Antrian $antrian)
    {
        $kode = $antrian->kode;

        return view('frontend.antrian.create',[
            'antrian' => $antrian,
            'kode'    => $kode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'antrian_id' => 'required|exists:antrians,id',
            'tanggal' => 'required|date',
            'kode' => 'required|string',
            'nama_lengkap' => 'required|string',
            'nomor_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        AntrianStore::create($validated + [
            'waktu_ambil' => now(),
        ]);

        return back()->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
