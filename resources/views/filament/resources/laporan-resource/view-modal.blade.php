<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h3 class="text-lg font-medium">Informasi Antrian</h3>
            <dl class="mt-2 space-y-2">
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Kode:</dt>
                    <dd class="text-sm font-semibold">{{ $record->kode }}</dd>
                </div>
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Tanggal:</dt>
                    <dd class="text-sm">{{ \Carbon\Carbon::parse($record->tanggal)->format('j F Y') }}</dd>
                </div>
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Status:</dt>
                    <dd class="text-sm">
                        @php
                            $color = match($record->status) {
                                'selesai' => 'text-green-600',
                                'dilewati' => 'text-blue-600',
                                'daftar' => 'text-gray-600',
                                'dipanggil' => 'text-amber-600',
                                default => 'text-gray-600'
                            };
                        @endphp
                        <span class="{{ $color }} font-medium">{{ ucfirst($record->status) }}</span>
                    </dd>
                </div>
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Layanan:</dt>
                    <dd class="text-sm">{{ $record->antrian->nama_layanan ?? '-' }}</dd>
                </div>
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Waktu Ambil:</dt>
                    <dd class="text-sm">{{ \Carbon\Carbon::parse($record->waktu_ambil)->format('j F Y H:i:s') }}</dd>
                </div>
            </dl>
        </div>

        <div>
            <h3 class="text-lg font-medium">Data Pelanggan</h3>
            <dl class="mt-2 space-y-2">
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Nama Lengkap:</dt>
                    <dd class="text-sm">{{ $record->nama_lengkap }}</dd>
                </div>
                @if($record->email)
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Email:</dt>
                    <dd class="text-sm">{{ $record->email }}</dd>
                </div>
                @endif
                @if($record->no_telepon)
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">No. Telepon:</dt>
                    <dd class="text-sm">{{ $record->no_telepon }}</dd>
                </div>
                @endif
                @if($record->alamat)
                <div class="grid grid-cols-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat:</dt>
                    <dd class="text-sm">{{ $record->alamat }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>

    @if($record->keterangan)
    <div>
        <h3 class="text-lg font-medium">Keterangan</h3>
        <div class="mt-2 p-3 bg-gray-50 rounded-md">
            <p class="text-sm text-gray-700">{{ $record->keterangan }}</p>
        </div>
    </div>
    @endif

    <div class="mt-4 text-right text-xs text-gray-500">
        <p>Dibuat: {{ $record->created_at->format('d/m/Y H:i:s') }}</p>
        @if($record->updated_at->ne($record->created_at))
            <p>Terakhir diperbarui: {{ $record->updated_at->format('d/m/Y H:i:s') }}</p>
        @endif
    </div>
</div>
