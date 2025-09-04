<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\AntrianStore;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;



class AntrianController extends Controller
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
            'antrian' => $antrian,
            'kode' => $kode,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Antrian $antrian)
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

        return view('frontend.antrian.create', [
            'antrianList' => $antrianList,
            'antrian' => $antrian,
            'kode' => $kode,
        ]);
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'antrian_id'    => 'required|exists:antrians,id',
            'tanggal'       => 'required|date',
            'nama_lengkap'  => 'required|max:255|string',
            'nomor_hp'      => 'required|max:255|string',
            'alamat'        => 'required|max:255',
        ]);

        // Ambil data antrian
        $antrian = Antrian::findOrFail($validated['antrian_id']);
        $service_code = $antrian->kode;

        // Hitung jumlah antrian yang sudah terdaftar pada tanggal tersebut
        $antrian_count = AntrianStore::where('antrian_id', $antrian->id)
            ->where('tanggal', $validated['tanggal'])
            ->count();

        // Hitung sisa kuota
        $sisa_kuota = $antrian->kuota - $antrian_count;

        // Validasi sisa kuota
        if ($sisa_kuota <= 0) {
            return redirect('/antrian')->with('error', 'Maaf, kuota antrian hari ini sudah penuh. Silakan coba di hari lain.');
        }

        // Ambil record terakhir untuk kode antrian
        $last_record = AntrianStore::where('tanggal', $validated['tanggal'])
            ->where('kode', 'like', $service_code . '%')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$last_record) {
            $next_kode = '001';
        } else {
            $last_kode_int = intval(substr($last_record->kode, -3));
            $next_kode = str_pad(++$last_kode_int, 3, '0', STR_PAD_LEFT);
        }

        // Buat kode antrian lengkap
        $kode_antrian = $service_code . '-' . $next_kode;

        // Cek duplikasi kode
        $existing_record = AntrianStore::where('kode', $kode_antrian)
            ->where('tanggal', $validated['tanggal'])
            ->first();

        if ($existing_record) {
            return redirect('/antrian')->with('error', 'Maaf, gagal mengambil antrian. Silakan coba di hari lain.');
        }
        $status_antrian = 'daftar';
        // Tambahkan data tambahan sebelum simpan
        $validated['kode'] = $kode_antrian;
        $validated['status'] = $status_antrian;
        $validated['user_id'] = auth()->user()->id;
        $validated['kuota'] = $antrian->kuota; // hanya untuk catatan snapshot, bukan kuota yang berkurang

        AntrianStore::create($validated + [
            'waktu_ambil' => now(),
        ]);

        return redirect('/antrian')->with('success', 'Berhasil Mengambil Antrian <strong>' . $antrian->nama_layanan . '</strong>.');
    }




    public function detail(Antrian $antrian)
    {

        $antrianList = Antrian::all();

        return view('frontend.antrian.detail', [
            'antrianList' => $antrianList,
            'antrian' => $antrian,
            'detailAntrian' => AntrianStore::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function destroy(string $id)
    {
        $antrian = AntrianStore::findOrFail($id);
        $antrian->delete();
        return redirect('/antrian/detail')->with('success', 'Berhasil Menghapus Antrian');

    }

    public function cetakKodeAntrian(AntrianStore $id)
    {
        $cetakKodeAntrian = AntrianStore::find($id->id);

        $logoPath = public_path('storage/logo/logo.png');
        $logo = base64_encode(file_get_contents($logoPath));

        $pdf = Pdf::loadView('frontend.antrian.kode-antrian', [
            'cetakKodeAntrian' => $cetakKodeAntrian,
            'logo' => $logo
        ]);

        return $pdf->stream('kode-antrian.pdf');
    }
}
