<div class="modal fade" id="modalTambahSurat">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('surat.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Surat</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" class="form-control" name="nomor_surat" value="{{ $generatedNomor ?? '' }}" readonly required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Surat</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label for="keterangan">Jenis Surat</label>
                    <select class="form-control" id="keterangan" name="keterangan" required>
                        <option value="" disabled selected>Pilih jenis surat:</option>
                        <option value="Surat Informasi IT">Surat Informasi IT</option>
                        <option value="Surat Pengajuan Barang">Surat Pengajuan Barang</option>
                        <option value="Surat Berita Acara Kerusakan">Surat Berita Acara Kerusakan</option>
                        <option value="Surat Terima Barang">Surat Terima Barang</option>
                        <option value="Surat Keluar Barang">Surat Keluar Barang</option>
                        <option value="Surat Peminjaman Barang">Surat Peminjaman Barang</option>
                        <option value="Surat Pemeliharaan Barang">Surat Pemeliharaan Barang</option>
                        <option value="Surat Pengembalian Barang">Surat Pengembalian Barang</option>
                        <option value="Surat Mutasi Barang">Surat Mutasi Barang</option>
                        <option value="Surat Lainnya">Surat Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto">Unggah File (PDF/JPG/PNG)</label>
                    <input type="file" class="form-control-file" name="foto" accept=".pdf,.jpg,.jpeg,.png">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button>
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
