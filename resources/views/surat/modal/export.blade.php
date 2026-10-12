<!-- Modal Export Surat -->
<div class="modal fade" id="modalExportSurat" tabindex="-1" role="dialog" aria-labelledby="modalExportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('surat.export') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalExportLabel">Export Data Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="extension">Pilih Format Export</label>
                    <select name="extension" id="extension" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Format --</option>
                        <option value="pdf">PDF (Cetak)</option>
                        <option value="xlsx">Excel (.xlsx)</option>
                        <option value="xls">Excel 97-2003 (.xls)</option>
                        <option value="csv">CSV (.csv)</option>
                    </select>
                    <small class="form-text text-muted mt-1">
                        Pastikan memilih format file sesuai kebutuhan laporan atau dokumen.
                    </small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </form>
    </div>
</div>
