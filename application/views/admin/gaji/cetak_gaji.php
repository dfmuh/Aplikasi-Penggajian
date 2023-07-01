<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>
	<center>
		<h1>PT. Sarwa Karya Wiguna</h1>
		<h2>Laporan Gaji Karyawan</h2>
	</center>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?php echo $tahun ?></td>
		</tr>
	</table>
	<table class="table table-bordered table-triped">
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">NIP</th>
			<th class="text-center">Nama Karyawan</th>
			<th class="text-center">Jenis Kelamin</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">Gaji Pokok</th>
			<th class="text-center">Tj. Penugasan</th>
			<th class="text-center">Uang Makan</th>
			<th class="text-center">Pajak</th>
			<th class="text-center">BPJS</th>
			<th class="text-center">Total Gaji</th>
		</tr>
		<?php $no = 1;
		foreach ($cetak_gaji as $g) : ?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td class="text-center"><?php echo $g->nip ?></td>
				<td class="text-center"><?php echo $g->nama_karyawan ?></td>
				<td class="text-center"><?php echo $g->jenis_kelamin ?></td>
				<td class="text-center"><?php echo $g->nama_jabatan ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->tj_penugasan, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->pajak, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->bpjs, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok + $g->tj_penugasan + $g->uang_makan - $g->pajak - $g->bpjs, 0, ',', '.') ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<table width="100%">
		<tr>
			<td></td>
			<td width="200px">
				<p>Palembang, <?php echo date("d M Y") ?> <br> Direktur</p>
				<br>
				<br>
				<p>_____________________</p>
			</td>
		</tr>
	</table>
</body>

</html>

<script type="text/javascript">
	window.print();
</script>