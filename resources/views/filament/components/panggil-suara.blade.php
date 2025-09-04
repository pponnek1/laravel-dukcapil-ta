<button
    onclick="responsiveVoice.speak('Nomor antrian {{ $record->kode }}, atas nama {{ $record->nama_lengkap }}', 'Indonesian Female');
             window.livewire.emit('panggil-antrian', {{ $record->id }});"
    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
    🔊 Panggil
</button>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=sYnAHpjA"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('script'))
            // Sisipkan skrip dari session ke halaman
            document.body.insertAdjacentHTML('beforeend', `{{ session('script') }}`);
        @endif
    });
</script>
