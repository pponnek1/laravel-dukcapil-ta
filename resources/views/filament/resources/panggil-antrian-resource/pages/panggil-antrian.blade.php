<x-filament::page>
    <x-filament::card>
        <h2 class="text-2xl font-bold mb-4">
            Pendaftar untuk Layanan {{ $record->nama_layanan }}
        </h2>

        {{ $this->table }}

        @push('scripts')
        <script>
            function panggilAntrianButton(el) {
                    // Validasi apakah ini tombol panggil
                    if (!el || el.dataset.role !== 'panggil-button') {
                        console.warn("❌ Bukan tombol panggil.");
                        return;
                    }

                    // Ambil data dari tombol
                    const id = el.dataset.id;
                    const nama = el.dataset.nama || 'Tanpa Nama';
                    const kode = el.dataset.kode || 'Tanpa Kode';
                    const waktu = el.dataset.waktu || 'Tanpa Waktu';

                    // Format pesan untuk suara
                    const pesan = `Nomor antrian ${kode}, atas nama ${nama}, silakan ke loket sekarang.`;
                    console.log("🔊 Memanggil:", pesan);

                    // Cek apakah SpeechSynthesis tersedia di browser
                    if ('speechSynthesis' in window) {
                        // Membuat objek SpeechSynthesisUtterance
                        const utterance = new SpeechSynthesisUtterance(pesan);

                        // Pilih bahasa dan suara (jika ada)
                        utterance.lang = 'id-ID'; // Bahasa Indonesia
                        const voices = speechSynthesis.getVoices();
                        utterance.voice = voices.find(voice => voice.lang === 'id-ID') || null; // Pilih suara Bahasa Indonesia (jika ada)

                        // Atur kecepatan suara
                        utterance.rate = 0.9; // Kecepatan suara (1 = normal)

                        // Mulai bicara
                        speechSynthesis.speak(utterance);
                    } else {
                        alert(pesan); // Fallback jika SpeechSynthesis tidak tersedia
                    }
                }

                // Pastikan suara sudah siap
                speechSynthesis.onvoiceschanged = function() {
                    const voices = speechSynthesis.getVoices();
                    console.log(voices); // Menampilkan daftar suara yang tersedia
                };
        </script>
        @endpush
    </x-filament::card>
</x-filament::page>
