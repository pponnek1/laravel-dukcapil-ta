<?php

namespace App\Http\Controllers;
use App\Models\Antrianstore;

use Illuminate\Http\Request;

class AntrianstoreController extends Controller
{
    public function panggilAntrian($id)
    {
        $antrian = AntrianStore::findOrFail($id);

        // Mengupdate waktu panggilan
        $antrian->dipanggil_pada = now();
        $antrian->save();

        // Memanggil suara menggunakan ResponsiveVoice
        return response()->json([
            'message' => 'Antrian dipanggil!',
            'script' => "<script src='https://code.responsivevoice.org/responsivevoice.js?key=sYnAHpjA'></script>
                        <script>
                            responsiveVoice.speak('Antrian dengan kode {$antrian->kode}, Nama: {$antrian->nama_lengkap}, silakan menuju loket.');
                        </script>"
        ]);
    }
}
