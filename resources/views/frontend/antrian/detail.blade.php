@extends('layouts.main')

@section('content')

<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <div class="section-title">
            <h2>Detail Antrian</h2>
            <h3>Detail Antrian {{ Auth()->user()->name }}</h3>
        </div>

        <div class="row">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col">
                <!-- Mengecek Kondisi Apakah User Sudah Mengambil Antrian Atau Belum, Jika belum maka tampilkan alert ini -->
                @if ($detailAntrian->isEmpty())
                <div class="alert alert-warning" role="alert"> Anda belum mengambil antrian dari layanan apapun.
                    Silahkan ambil di Menu <a href="/antrian" class="alert-link">Ambil Antrian</a> </div>
                <!-- Jika sudah mengisi sebelumnya, maka tampilkan Datanya -->
                @else
                <div class="row">
                    <div class="col-lg-12">
                        @if ($detailAntrian->isEmpty())
                        <div class="alert alert-warning text-center" role="alert">
                            <h5>Belum Ada Antrian</h5>
                            <p>Anda belum mengambil antrian dari layanan manapun.</p>
                            <a href="/antrian" class="btn btn-primary mt-2">Ambil Antrian</a>
                        </div>
                        @else
                        @foreach ($detailAntrian as $detail)
                        <div class="card shadow-lg mb-4">
                            <div class="card-header bg-gradient-primary text-white rounded-top-4">
                                <h4 class="mb-0">Detail Antrian</h4>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <h5 class="text-muted small">Nama</h5>
                                        <div class="fw-semibold">{{ $detail->nama_lengkap }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted small">Nomor Antrian</div>
                                        <div class="fw-semibold">{{ $detail->kode }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted small">Layanan</div>
                                        <div class="fw-semibold">{{ $detail->antrian->nama_layanan }}</div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <div class="text-muted small">Alamat</div>
                                        <div class="fw-semibold">{{ $detail->alamat }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted small">Tanggal Datang</div>
                                        <div class="fw-semibold">{{ date('d-m-Y', strtotime($detail->tanggal)) }}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-muted small mb-2">Aksi</div>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <!-- Hapus -->
                                            <form id="{{ $detail->id }}" action="/antrian/detail/{{ $detail->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm swal-confirm" data-form="{{ $detail->id }}">
                                                    <i class="bi bi-trash me-1"></i> Hapus
                                                </button>
                                            </form>

                                            <!-- Cetak -->
                                            <a href="/antrian/kode-antrian/{{ $detail->id }}" target="_blank" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-printer me-1"></i> Cetak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
