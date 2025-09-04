{{-- resources/views/vendor/filament/components/page.blade.php --}}
<x-filament::layouts.app :title="$title">
    <x-slot name="header">
        {{ $header }}
    </x-slot>

    {{ $slot }}

    {{-- Load ResponsiveVoice --}}
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=sYnAHpjA"></script>

    {{-- Script Panggil Antrian --}}
    <script>
        document.addEventListener('play-panggil', function (event) {
            const nama = event.detail.nama;

            // Play audio notification
            const audio = new Audio('/audio/notif-panggil.mp3');
            audio.play();

            // Show toast notification
            window.Filament?.notification?.show({
                title: 'Memanggil Antrian',
                body: nama,
                type: 'success',
            });

            // ResponsiveVoice untuk sebut nama
            responsiveVoice.speak("Memanggil antrian " + nama, "Indonesian Female");
        });
    </script>
</x-filament::layouts.app>
