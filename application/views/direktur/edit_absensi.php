<div class="ml-5">
    <h1>Form Absensi</h1>
    <a href="<?php echo site_url('direktur/absensi'); ?>" class="btn btn-secondary">Kembali ke Daftar Absensi</a>
    <?php if ($this->session->flashdata('error')) { ?> <!-- Tampilkan pesan error jika ada -->
        <p style="color:red"><?php echo $this->session->flashdata('error'); ?></p>
    <?php } ?>
    <div class="mt-3">
        <form method="post" action="<?php echo site_url('direktur/absensi/save_absensi/' . $weekday); ?>">
            <div class="form-group">
                <label for="tanggal_absensi">Tanggal Absensi</label>
                <p><?php echo $weekday; ?></p> <!-- Menampilkan teks biasa untuk tanggal absensi -->
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keterangan" id="hadir" value="Hadir">
                    <label class="form-check-label" for="hadir">Hadir</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keterangan" id="izin" value="Izin">
                    <label class="form-check-label" for="izin">Izin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="keterangan" id="alpha" value="Alpha">
                    <label class="form-check-label" for="alpha">Alpha</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>