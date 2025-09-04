<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Antrian - Dukcapil Klaten</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            margin-bottom: 10px;
        }

        header h1 {
            margin: 0;
            font-size: 18px;
        }

        header p {
            margin: 2px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #e2e8f0;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <header>
        <div class="container">

            <div class="logo">
            <img src="{{ public_path('storage/logo/logo.png') }}" alt="Logo" width="120">
            </div>
            <h1>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h1>
            <p>Kabupaten Klaten</p>
            <p><strong>Laporan Antrian</strong></p>
            <p>{{ \Carbon\Carbon::now()->format('d F Y, H:i') }}</p>

        </div>
    </header>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Layanan</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->antrian->nama_layanan ?? '-' }}</td>
                <td>{{ $item->nomor_hp }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; font-style: italic;">Tidak ada data tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <footer>
        <p>Dicetak oleh Sistem Antrian Dukcapil Klaten</p>
    </footer>

</body>

</html>
