<script>
    $(document).ready(function () {
        // Modal Show
        $(".show-modal").click(function () {
            const id = $(this).data("id");
            let url = "{{ route('api.surat.show', ':id') }}".replace(":id", id);

            $.get(url, function (res) {
                const data = res.data;

                $("#show_surat #nomor_surat").val(data.nomor_surat || "");
                $("#show_surat #nama").val(data.nama || "");
                if (data.tanggal) {
                    const tanggal = new Date(data.tanggal);
                    const formatted = tanggal.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    $("#show_surat #tanggal").val(formatted);
                } else {
                    $("#show_surat #tanggal").val("");
                }
                $("#show_surat #keterangan").val(data.keterangan || "");

                if (data.foto) {
                    $("#file_preview").html(`<a href="/storage/${data.foto}" target="_blank">Lihat File</a>`);
                } else {
                    $("#file_preview").html(`<span class="text-muted">Tidak ada file</span>`);
                }

                $("#show_surat").modal("show");
            }).fail(function () {
                alert("Gagal memuat detail surat.");
            });
        });

        // Modal Edit
        $(".edit-modal").click(function () {
            const id = $(this).data("id");
            const url = "{{ route('api.surat.show', ':id') }}".replace(":id", id);
            const formAction = "{{ route('surat.update', ':id') }}".replace(":id", id);

            $.get(url, function (res) {
                const data = res.data;

                const $form = $("#edit_surat_modal form");

                $form.attr("action", formAction);
                $form.find("#nomor_surat").val(data.nomor_surat || "");
                $form.find("#nama").val(data.nama || "");
                $form.find("#tanggal").val(data.tanggal || "");
                $form.find("#keterangan").val(data.keterangan || "");

                if (data.foto) {
                    $("#current_file").html(`<a href="/storage/${data.foto}" target="_blank">Lihat File Saat Ini</a>`);
                } else {
                    $("#current_file").html(`<span class="text-muted">Tidak ada file</span>`);
                }

                $("#edit_surat_modal").modal("show");
            }).fail(function () {
                alert("Gagal memuat data untuk edit surat.");
            });
        });
    });
    $(document).on('click', '.preview-file', function (e) {
        e.preventDefault();

        const url = $(this).data('foto');
        const ext = $(this).data('ext');
        const $preview = $('#previewContent');
        $preview.html(''); // reset

        if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
            $preview.html(`<img src="${url}" class="img-fluid" alt="Preview Gambar">`);
        } else if (ext === 'pdf') {
            $preview.html(`<iframe src="${url}" frameborder="0" width="100%" height="500px"></iframe>`);
        } else {
            $preview.html(`<p class="text-muted">Format tidak didukung untuk preview.</p>`);
        }

        $('#previewModal').modal('show');
    });
</script>
