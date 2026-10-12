<div class="modal fade" id="modalImportSurat">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('surat.import') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Import Surat (Excel)</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="file">Pilih File Excel</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-info">Import</button>
            </div>
        </form>
    </div>
</div>
