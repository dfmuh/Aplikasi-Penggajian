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
		<h2>Slip Gaji Karyawan</h2>
		<hr style="width: 50%; border-width: 5px; color: black">
	</center>

	<?php foreach ($print_slip as $ps) : ?>

		<table style="width: 100%">
			<tr>
				<td width="20%">Nama Karyawan</td>
				<td width="2%">:</td>
				<td><?php echo $ps->nama_karyawan ?></td>
			</tr>
			<tr>
				<td>NIP</td>
				<td>:</td>
				<td><?php echo $ps->nip ?></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td><?php echo $ps->nama_jabatan ?></td>
			</tr>
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

		<table class="table table-striped table-bordered mt-3">
			<tr>
				<th class="text-center" width="5%">No</th>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Jumlah</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Gaji Pokok</td>
				<td>Rp. <?php echo number_format($ps->gaji_pokok, 0, ',', '.') ?></td>
			</tr>

			<tr>
				<td>2</td>
				<td>Tunjangan Penugasan</td>
				<td>Rp. <?php echo number_format($ps->tj_penugasan, 0, ',', '.') ?></td>
			</tr>

			<tr>
				<td>3</td>
				<td>Uang Makan</td>
				<td>Rp. <?php echo number_format($ps->uang_makan, 0, ',', '.') ?></td>
			</tr>

			<tr>
				<th colspan="2" style="text-align: right;">Total Gaji : </th>
				<th>Rp. <?php echo number_format($ps->gaji_pokok + $ps->tj_penugasan + $ps->uang_makan, 0, ',', '.') ?></th>
			</tr>
		</table>

		<table width="100%">
			<tr>
				<td></td>
				<td>
					<p>Karyawan</p>
					<br>
					<br>
					<p class="font-weight-bold"><?php echo $ps->nama_karyawan ?></p>
				</td>

				<td width="200px">
					<p>Palembang, <?php echo date("d M Y") ?> <br> Admin,</p>
					<br>
					<br>
					<p>___________________</p>
				</td>
			</tr>
		</table>

	<?php endforeach; ?>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>