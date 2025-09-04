<form action="{{ route('store.antrian') }}" method="POST">
    @csrf
    <input name="user_id" placeholder="User ID" />
    <input name="antrian_id" placeholder="Antrian ID" />
    <input name="tanggal" type="date" />
    <input name="kode" placeholder="Kode" />
    <input name="nama_lengkap" placeholder="Nama Lengkap" />
    <input name="nomor_hp" placeholder="Nomor HP" />
    <input name="alamat" placeholder="Alamat" />
    <button type="submit">Simpan</button>
</form>
