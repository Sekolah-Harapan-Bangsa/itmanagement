<!-- Modal Upload Task -->
<div class="modal fade" id="modalUploadTask" tabindex="-1" aria-labelledby="modalUploadTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUploadTaskLabel">Upload Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="alert alert-info" role="alert">
                        Untuk mengunggah task, unduh template Excel task terlebih dahulu 
                        <a href="{{ asset('import-task-template.xlsx') }}" class="alert-link">
                            <i class="fas fa-download"></i> di sini
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="task_file">Pilih berkas<span class="font-weight-bold text-danger">*</span></label>
                        <input type="file" class="form-control" name="file" id="task_file" required accept=".xls,.xlsx">
                    </div>
                    <small class="text-muted">Pastikan format file sesuai template Task.</small>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
