<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.antrian') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="antrian_id" id="antrian_id" value ="{{ $antrian->id }}">

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Kedatangan</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                            name="tanggal" placeholder="Tanggal Antrian" required>
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                            id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                            rows="3" placeholder="Masukkan Alamat Lengkap" required></textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomor_hp"
                            name="nomor_hp" placeholder="Masukkan nomor hp aktif" required>
                        @error('nomor_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button id="btnSimpan" type="submit" class="btn btn-primary float-end">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function () {
        $('#exampleModal form').submit(function (event) {
            event.preventDefault();

            var form = $(this);

            var user_id = form.find('input[name="user_id"]').val();
            var antrian_id = form.find('#antrian_id').val();
            console.log("Antrian ID   : ", antrian_id);
            var nama_lengkap = form.find('#nama_lengkap').val();
            var alamat = form.find('#alamat').val();
            var nomorhp = form.find('#nomor_hp').val();
            var tanggal = form.find('#tanggal').val();
            var error = false;

            // Log semua data input ke console
            console.log("====== DATA FORM ANTRIAN ======");
            console.log("User ID      : ", user_id);
            console.log("Antrian ID   : ", antrian_id);
            console.log("Nama Lengkap : ", nama_lengkap);
            console.log("Alamat       : ", alamat);
            console.log("Nomor HP     : ", nomorhp);
            console.log("Tanggal      : ", tanggal);
            console.log("================================");

            // Validasi manual
            if (!nama_lengkap) {
                form.find('#nama_lengkap').addClass('is-invalid');
                error = true;
            } else {
                form.find('#nama_lengkap').removeClass('is-invalid');
            }

            if (!alamat) {
                form.find('#alamat').addClass('is-invalid');
                error = true;
            } else {
                form.find('#alamat').removeClass('is-invalid');
            }

            if (!nomorhp) {
                form.find('#nomor_hp').addClass('is-invalid');
                error = true;
            } else {
                form.find('#nomor_hp').removeClass('is-invalid');
            }

            if (!tanggal) {
                form.find('#tanggal').addClass('is-invalid');
                error = true;
            } else {
                form.find('#tanggal').removeClass('is-invalid');
            }

            if (!error) {
                console.log("✅ Form valid. Mengirim...");
                form.unbind('submit').submit(); // Submit ulang setelah validasi manual
            } else {
                console.log("❌ Form tidak valid. Gagal submit.");
            }
        });
    });
</script>

