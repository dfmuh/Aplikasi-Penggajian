<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<div class="card mb-3">
		<div class="card-header bg-primary text-white">
			Filter Data Gaji Karyawan
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
	Menampilkan Data Gaji Karyawan Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
</div>

<?php

$jml_data = count($gaji);
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
								<th class="text-center">Nama Karyawan</th>
								<th class="text-center">Jabatan</th>
								<th class="text-center">Gaji Pokok</th>
								<th class="text-center">Tj. Penugasan</th>
								<th class="text-center">Uang Makan</th>
								<th class="text-center">Pajak</th>
								<th class="text-center">BPJS</th>
								<th class="text-center">Total Gaji</th>
								<th class="text-center">Status Bayar</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($gaji as $g) :
								$isExist = false;
								foreach ($cek as $c) :
									if ($c->nip == $g->nip && $bulan == $c->bulan && $tahun == $c->tahun) {
										$isExist = true; // Mengubah variabel $hasMinusSquare menjadi $isExist
										break; // Keluar dari loop jika data sudah ditemukan
									}
								endforeach;

								if ($isExist) {
									if ($g->gaji_pokok_gaji > 5000000) {
										$pajak  = $g->gaji_pokok_gaji * 0.15;
									} else {
										$pajak  = $g->gaji_pokok_gaji * 0.05;
									}

									$bpjs = $g->gaji_pokok_gaji * 0.01;
							?>
									<tr>
										<td class="text-center"><?php echo $no++ ?></td>
										<td class="text-center"><?php echo $g->nip ?></td>
										<td class="text-center"><?php echo $g->nama_karyawan ?></td>
										<td class="text-center"><?php echo $g->nama_jabatan ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok_gaji, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->tj_penugasan_gaji, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->uang_makan_gaji, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($pajak, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($bpjs, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok_gaji + $g->tj_penugasan_gaji + $g->uang_makan_gaji - $pajak - $bpjs, 0, ',', '.') ?></td>
										<td class="text-center"><i class="fas fa-check"></i></td>
									</tr>
								<?php } else {
									$makan = $g->uang_makan_jabatan * $g->hadir;
									if ($g->gaji_pokok_jabatan > 5000000) {
										$pajak  = $g->gaji_pokok_jabatan * 0.15;
									} else {
										$pajak  = $g->gaji_pokok_jabatan * 0.05;
									}
									$bpjs = $g->gaji_pokok_jabatan * 0.01;
								?>
									<tr>
										<td class="text-center"><?php echo $no++ ?></td>
										<td class="text-center"><?php echo $g->nip ?></td>
										<td class="text-center"><?php echo $g->nama_karyawan ?></td>
										<td class="text-center"><?php echo $g->nama_jabatan ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok_jabatan, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->tj_penugasan_jabatan, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($makan, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($pajak, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($bpjs, 0, ',', '.') ?></td>
										<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok_jabatan + $g->tj_penugasan_jabatan + $makan - $pajak - $bpjs, 0, ',', '.') ?></td>
										<td class="text-center">
											<a href="<?php echo site_url('admin/data_penggajian/edit_status/' . $bulan . '/' . $tahun . '/' . $g->nip . '/' . $g->gaji_pokok_jabatan . '/' . $g->tj_penugasan_jabatan . '/' . $makan . '/' . $pajak . '/' . $bpjs); ?>">
												<span class="fas fa-minus-square"></span>
											</a>
										</td>
									</tr>
							<?php }
							endforeach; ?>
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data gaji masih kosong</span>
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
				Data gaji masih kosong
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>