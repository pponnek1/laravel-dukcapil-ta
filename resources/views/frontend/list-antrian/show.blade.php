@extends('layouts.main')

@section('content')

<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <div class="section-title">
            <h2>Antrian</h2>
            <h3>Daftar Antrian {{ $listPendaftar->nama_layanan }}</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg p-4 mb-4">
                    <div class="row g-3 align-items-end mb-4">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="tanggal" class="form-label">Pilih Tanggal Antrian</label>
                                <input type="date" class="form-control form-control-sm" id="tanggal">
                            </div>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button id="reset-filter" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="dataTable" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tgl. Antrian</th>
                                    <th>Nama</th>
                                    <th>status</th>
                                    <th>Nomor Antrian</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPendaftar->antrianstore as $antrian)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($antrian->tanggal)->format('Y-m-d') }}</td>
                                    <td>{{ $antrian->nama_lengkap }}</td>
                                    <td>{{ $antrian->status }}</td>
                                    <td>{{ $antrian->kode }}</td>
                                    <td>{{ $antrian->alamat }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
                // Inisialisasi DataTable
                var table = $('#dataTable').DataTable();

                // Ketika tanggal berubah, atur filter pada DataTable
                $('#tanggal').on('change', function() {
                    var tanggal = $('#tanggal').val();
                    table.columns(1).search(tanggal).draw();
                });

                // Ketika tombol reset di klik, hapus filter pada DataTable
                $('#reset-filter').on('click', function() {
                $('#tanggal').val('');
                $('#antrian_id').val('').trigger('change');
                table.columns().search('').draw();
            });
        });

    </script>
</section>

@endsection
