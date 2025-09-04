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
        @foreach($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d/m/Y') }}</td>
            <td>{{ $item['kode'] }}</td>
            <td>{{ $item['nama_lengkap'] }}</td>
            <td>{{ $item['antrian']['nama_layanan'] ?? '-' }}</td>
            <td>{{ $item['nomor_hp'] }}</td>
            <td>{{ $item['alamat'] }}</td>
            <td>{{ ucfirst($item['status']) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
