@extends('layouts.main')

@section('content')

@include('frontend.antrian.create')

<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <div class="section-title">
            <h2>Daftar Antrian</h2>
            <h3>Silahkan pilih antrian yang ingin anda ambil</h3>
        </div>

        <!-- ALERT GLOBAL MUNCUL DI ATAS -->
        <div id="globalAlertPlaceholder"></div>

        <div class="container">
            <div class="row gy-5">

                @if(session()->has('success'))
                <script>
                    window.addEventListener('DOMContentLoaded', () => {
                        const msg = `{!! session('success') !!}`;
                        showGlobalAlert(msg, 'success');
                    });
                </script>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @foreach ($antrianList as $key => $antrian)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi {{ $antrian->icon }}"></i>
                        </div>
                        <h3>{{ $antrian->nama_layanan }}</h3>
                        <h6>{{ $antrian->deskripsi }}</h6>

                        <div class="mt-3">
                            @auth
                            @php
                            $tanggalHariIni = now()->toDateString(); // Mendapatkan tanggal hari ini
                            // Menyaring data antrian berdasarkan user_id dan tanggal hari ini menggunakan query builder
                            $antrianStoreHariIni = $antrian->antrianStore()->where('user_id',
                            Auth::id())->whereDate('tanggal', $tanggalHariIni)->exists();
                            @endphp

                            @if ($antrianStoreHariIni)
                            <button type="button" class="btn btn-secondary containsButtonGlobal"
                                data-nama="{{ $antrian->nama_layanan }}">Sudah Ambil Antrian</button>
                            @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-id="{{ $antrian->id }}" data-bs-target="#exampleModal">Ambil Antrian</button>
                            @endif
                            @else
                            <button type="button" class="btn btn-primary" id="liveAlertBtn{{ $key }}"
                                data-id="{{ $key }}">Ambil Antrian</button>
                            @endauth
                        </div>
                    </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample{{ $key }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $key }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                                    aria-controls="collapse{{ $key }}">
                                    Informasi & Persyaratan
                                </button>
                            </h2>
                            <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample{{ $key }}">
                                <div class="accordion-body">
                                    {{ $antrian->persyaratan }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

<!-- Modal: Ambil Antrian -->
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var slug = button.data('id');
        var modal = $(this);

        modal.find('.modal-title').text('Pengambilan Nomor Antrian');
        modal.find('.modal-body #antrian_id').val(slug);

        console.log('ID yang dimasukkan ke input hidden:', slug);
    });
</script>

<!-- GLOBAL ALERT HANDLER -->
<script>
    const globalAlertPlaceholder = document.getElementById('globalAlertPlaceholder');
    const showGlobalAlert = (message, type = 'danger', duration = 5000) => {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        globalAlertPlaceholder.innerHTML = '';
        globalAlertPlaceholder.append(wrapper);

        setTimeout(() => {
            const alert = bootstrap.Alert.getOrCreateInstance(wrapper.querySelector('.alert'));
            alert.close();
        }, duration);
    }
</script>

<!-- Jika belum login -->
<script>
    const alertTriggers = document.querySelectorAll('[id^="liveAlertBtn"]');
    if (alertTriggers.length > 0) {
        alertTriggers.forEach(alertTrigger => {
            alertTrigger.addEventListener('click', () => {
                const auth = {{ auth()->check() ? 'true' : 'false' }};
                if (!auth) {
                    showGlobalAlert('Anda harus login terlebih dahulu', 'warning');
                }
            });
        });
    }
</script>

<!-- Jika sudah mengambil antrian -->
<script>
    document.querySelectorAll('.containsButtonGlobal').forEach(button => {
        button.addEventListener('click', function () {
            const nama = this.dataset.nama || 'layanan ini';
            showGlobalAlert(`Anda sudah mengambil antrian <strong>${nama}</strong>, <a href="/antrian/detail" class="alert-link">cek detail</a>`, 'danger');
        });
    });
</script>

@endsection
