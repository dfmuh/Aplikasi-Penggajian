<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<table class="table table-striped table-bordered">
		<tr>
			<th>Bulan/Tahun</th>
			<th>Gaji Pokok</th>
			<th>Tunjangan Penugasan</th>
			<th>Uang Makan</th>
			<th>Total Gaji</th>
		</tr>

		<?php foreach ($gaji as $g) : ?>
			<tr>
				<td><?php echo date('m/Y', strtotime($g->bulan . '/01/' . $g->tahun)); ?></td>
				<td>Rp. <?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->tj_penugasan, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->gaji_pokok + $g->tj_penugasan + $g->uang_makan, 0, ',', '.') ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

</div>
<!-- /.container-fluid -->