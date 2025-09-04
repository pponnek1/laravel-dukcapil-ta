<x-filament::page>
    <h1>Panggil Antrian</h1>

    @if ($antrian)
        <div class="space-y-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-semibold">Layanan yang Menunggu:</h2>
                <p><strong>Nama Layanan:</strong> {{ $antrian->antrian->nama_layanan }}</p>
                <p><strong>Nama Lengkap:</strong> {{ $antrian->nama_lengkap }}</p>
                <p><strong>Status:</strong> {{ ucfirst($antrian->status) }}</p>
                <p><strong>Waktu Antrian:</strong> {{ $antrian->waktu_ambil ? $antrian->waktu_ambil->format('d-m-Y H:i') : 'Belum Diambil' }}</p>
            </div>

            <div class="mt-4">
                <x-filament::button wire:click="panggilAntrian" color="primary">
                    Panggil Antrian Selanjutnya
                </x-filament::button>
            </div>
        </div>
    @else
        <p>Tidak ada antrian yang menunggu.</p>
    @endif
</x-filament::page>
