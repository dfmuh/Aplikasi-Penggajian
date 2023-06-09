<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Filter Data Absensi
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="staticEmail2">Bulan</label>
                    <select class="form-control ml-3" name="bulan">
                        <option value=""> Pilih Bulan </option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group mb-2 ml-5">
                    <label for="staticEmail2">Tahun</label>
                    <select class="form-control ml-3" name="tahun">
                        <option value=""> Pilih Tahun </option>
                        <?php $tahun = date('Y');
                        for ($i = $tahun; $i > $tahun - 10; $i--) { ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div>

                <?php
                if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                    $bulan = $_GET['bulan'];
                    $tahun = $_GET['tahun'];
                } else {
                    $bulan = date('m');
                    $tahun = date('Y');
                }
                ?>

                <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>

            </form>
        </div>
    </div>
</div>

<?php
if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
} else {
    $bulan = date('m');
    $tahun = date('Y');
}
?>

<div class="alert alert-info">
    Menampilkan Data Absensi Karyawan Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
</div>

<?php

$jml_data = count($absensi);
if ($jml_data > 0) { ?>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Karyawan</th>>
                                <th class="text-center">Hadir</th>
                                <th class="text-center">Izin</th>
                                <th class="text-center">Alpha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($absensi as $g) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $g->nip ?></td>
                                    <td class="text-center"><?php echo $g->nama_karyawan ?></td>
                                    <td class="text-center"><?php echo $g->hadir ?></td>
                                    <td class="text-center"><?php echo $g->izin ?></td>
                                    <td class="text-center"><?php echo $g->alpha ?></td>

                                </tr>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data absensi masih kosong</span>
<?php } ?>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data absensi masih kosong
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>