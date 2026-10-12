<div class="modal fade" id="taskDetailModal" tabindex="-1" role="dialog" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="taskDetailModalLabel">
                    <i class="fas fa-tasks"></i> Detail Task
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Body --}}
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Item:</strong> <span class="modal-item"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Jenis:</strong> <span class="modal-jenis"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Vendor PIC:</strong> <span class="modal-vendor"></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Deadline:</strong> <span class="modal-deadline"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Sisa Hari:</strong>
                        <span class="badge modal-sisa-hari">-</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <span class="badge modal-status">-</span>
                    </div>
                </div>

                <div class="form-group">
                    <strong>Keterangan:</strong>
                    <p class="modal-keterangan mb-0">-</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
