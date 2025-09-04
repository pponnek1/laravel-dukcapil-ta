@extends('layouts.main')

@section('content')

<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <div class="section-title">
            <h2>Antrian</h2>
            <h3>Cek Daftar Antrian</h3>
        </div>

        <div class="container">
            <div class="row gy-5">
                @foreach ($antrianList as $key => $antrian )
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi {{ $antrian->icon }}"></i>
                        </div>
                        <h3>{{ $antrian->nama_layanan }}</h3>
                        <h6>{{ $antrian->deskripsi }}</h6>

                        <div class="mt-3">
                            <a href="/daftar-antrian/{{ $antrian->slug }}" class="btn btn-primary mb-2">Cek Daftar Antrian</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
