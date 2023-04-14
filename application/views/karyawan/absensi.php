<!-- Tampilan Karyawan - Absensi -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Absensi</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Tanggal Absensi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $current_date = date('Y-m-d'); // Mendapatkan tanggal hari ini
                                $month = date('m');
                                $year = date('Y');

                                // Memanggil fungsi getWeekdaysOfMonth untuk mendapatkan daftar tanggal weekdays pada bulan saat ini
                                $weekdays = getWeekdaysOfMonth($month, $year);

                                if (!empty($weekdays)) {
                                    foreach ($weekdays as $weekday) { ?>
                                        <tr>
                                            <td><?php echo $weekday; ?></td>
                                            <td>
                                                <?php
                                                $keterangan = "";
                                                foreach ($absensi as $absen) {
                                                    if ($absen->tanggal_absensi == $weekday) {
                                                        $keterangan = $absen->keterangan;
                                                        break;
                                                    }
                                                }
                                                echo $keterangan;
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($weekday <= $current_date) { // Menampilkan tombol edit jika tanggal absensi <= tanggal hari ini 
                                                ?>
                                                    <?php if ($keterangan == "") { ?>
                                                        <a href="<?php echo site_url('karyawan/absensi/form_absensi/' . $weekday); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    <?php } else { ?>
                                                        Sudah Absen
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    Tidak dapat mengisi absen
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>