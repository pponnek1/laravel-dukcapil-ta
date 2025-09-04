<?php

// File: app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrianstore;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function exportPdf(Request $request)
    {
        $data = Antrianstore::with('antrian')
            ->when($request->antrian_id, fn ($q) => $q->where('antrian_id', $request->antrian_id))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->from, fn ($q) => $q->whereDate('tanggal', '>=', $request->from))
            ->when($request->to, fn ($q) => $q->whereDate('tanggal', '<=', $request->to))
            ->get();

        // $logoPath = public_path('app/public/logo/logo.png');
        // $logo = base64_encode(file_get_contents($logoPath));

        $pdf = Pdf::loadView('exports.laporan_pdf', [
            'data' => $data,
            // 'logo' => $logo,
            'request' => $request,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-' . now()->format('Y-m-d_H-i') . '.pdf');
    }
}
