<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".show-task").forEach(function (button) {
        button.addEventListener("click", function () {
            const modal = document.querySelector("#taskDetailModal");

            // Ambil data
            const item = this.dataset.item || "-";
            const jenis = this.dataset.jenis || "-";
            const vendor = this.dataset.vendor || "-";
            const deadline = this.dataset.deadline || "-";
            const sisa = parseInt(this.dataset.sisa) || 0;
            const status = this.dataset.status || "Pending";
            const keterangan = this.dataset.keterangan || "-";

            // Isi modal
            modal.querySelector(".modal-item").textContent = item;
            modal.querySelector(".modal-jenis").textContent = jenis;
            modal.querySelector(".modal-vendor").textContent = vendor;
            modal.querySelector(".modal-deadline").textContent = deadline;
            modal.querySelector(".modal-keterangan").textContent = keterangan;

            // Badge sisa hari
            const sisaHariBadge = modal.querySelector(".modal-sisa-hari");
            if (sisa > 30) {
                sisaHariBadge.className = "badge badge-success modal-sisa-hari";
                sisaHariBadge.textContent = `${sisa} Hari`;
            } else if (sisa > 0) {
                sisaHariBadge.className = "badge badge-warning modal-sisa-hari";
                sisaHariBadge.textContent = `${sisa} Hari`;
            } else {
                sisaHariBadge.className = "badge badge-danger modal-sisa-hari";
                sisaHariBadge.textContent = `${sisa} Hari`;
            }

            // Badge status
            const statusBadge = modal.querySelector(".modal-status");
            if (sisa <= 0) {
                statusBadge.className = "badge badge-danger modal-status";
                statusBadge.innerHTML = `<i class="fas fa-times"></i> Kadaluwarsa`;
            } else if (status === "Selesai") {
                statusBadge.className = "badge badge-primary modal-status";
                statusBadge.innerHTML = `<i class="fas fa-check-circle"></i> Selesai`;
            } else if (status === "Proses") {
                statusBadge.className = "badge badge-warning modal-status";
                statusBadge.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Proses`;
            } else {
                statusBadge.className = "badge badge-success modal-status";
                statusBadge.innerHTML = `<i class="fas fa-check"></i> Aktif`;
            }
        });
    });
});
</script>
