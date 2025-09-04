<div class="row p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <!-- Tanggal Bagian -->
        <div>
            <div class="flex items-center gap-2">
                <x-heroicon-s-calendar class="w-5 h-5 text-white/80" />
                <p class="text-l text-white/80">Hari ini</p>
            </div>
            <p class="text-3xl font-semibold">{{ $date }}</p>
        </div>

        <!-- Jam Bagian -->
        <div class="text-right">
            <div class="flex items-center justify-end gap-2">
                <x-heroicon-s-clock class="w-5 h-5 text-white/80" />
                <p class="text-sm text-white/80">Jam</p>
            </div>
            <p class="text-3xl font-mono font-bold tracking-wider" wire:poll.1s="updateTime">{{ $time }}</p>
        </div>
    </div>
</div>
