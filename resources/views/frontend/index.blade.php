@extends('layouts.main')

@section('content')

<section id="hero" class="hero section dark-background">

    <img src="{{ asset('assets/img/test-hero.jpg') }}" alt="" data-aos="fade-in">

    <div class="container">

        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-xl-6 col-lg-8">
                <h2>E-DUKCAPIL KLATEN<span>.</span></h2>
                <p>Dari Klaten Untuk Masa Depan: Dukcapil Digital, Solusi Modern</p>
            </div>
        </div>

        <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
            @foreach ($antrianList as $antrian)
            <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                    <i class="bi {{ $antrian->icon }}"></i>
                    <h3><a href="#">{{ $antrian->nama_layanan }}</a></h3>
                </div>
            </div>
            @endforeach


        </div>
    </div>

</section><!-- /Hero Section -->

<!-- About Section -->
<section id="about" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            <div class="col-lg-6 order-1 order-lg-2">
                <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 order-2 order-lg-1 content">
                <h3>Sistem Antrian Online Dukcapil Klaten</h3>
                <p class="fst-italic">
                    Mudah, cepat, dan praktis!
                    Gunakan layanan antrian online untuk mengurus KTP, KK, Akta Kelahiran, dan dokumen kependudukan
                    lainnya.
                </p>
                <ul>
                    <li><i class="bi bi-check2-all"></i> <span>Praktis: Daftar dari mana saja, kapan saja.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Cepat: Kurangi waktu tunggu di kantor DUKCAPIL.</span>
                    </li>
                    <li><i class="bi bi-check2-all"></i> <span>Transparan: Pantau status antrian dan layanan
                            Anda.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>Efisien: Petugas siap melayani sesuai jadwal yang Anda
                            pilih</span></li>
                </ul>
                <p>
                    Harap datang sesuai jadwal yang telah Anda pilih untuk kelancaran layanan.
                    Terima kasih telah menggunakan layanan antrian online DUKCAPIL Klaten.
                </p>
            </div>
        </div>

    </div>

</section><!-- /About Section -->
@endsection
