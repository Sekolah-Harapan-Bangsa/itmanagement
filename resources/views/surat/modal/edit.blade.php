<div class="modal fade" id="edit_surat_modal" tabindex="-1" role="dialog" aria-labelledby="editSuratLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editSuratLabel">Edit Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="nomor_surat">Nomor Surat</label>
                    <input type="text" class="form-control" name="nomor_surat" id="nomor_surat" readonly>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Surat</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
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
                    <label for="foto">File (kosongkan jika tidak ingin mengganti)</label>
                    <input type="file" class="form-control-file" name="foto" id="foto" accept=".pdf,.jpg,.jpeg,.png">
                    <div id="current_file" class="mt-2 text-muted"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
