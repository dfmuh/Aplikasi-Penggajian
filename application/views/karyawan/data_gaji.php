<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead class="thead-dark">
								<tr>
									<th>Bulan/Tahun</th>
									<th>Gaji Pokok</th>
									<th>Tunjangan Penugasan</th>
									<th>Uang Makan</th>
									<th>Pajak</th>
									<th>BPJS</th>
									<th>Total Gaji</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($gaji as $g) : ?>
									<tr>
										<td><?php echo date('m/Y', strtotime($g->bulan . '/01/' . $g->tahun)); ?></td>
										<td>Rp. <?php echo number_format($g->gaji_pokok, 0, ',', '.') ?></td>
										<td>Rp. <?php echo number_format($g->tj_penugasan, 0, ',', '.') ?></td>
										<td>Rp. <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
										<td>Rp. <?php echo number_format($g->pajak, 0, ',', '.') ?></td>
										<td>Rp. <?php echo number_format($g->bpjs, 0, ',', '.') ?></td>
										<td>Rp. <?php echo number_format($g->gaji_pokok + $g->tj_penugasan + $g->uang_makan - $g->pajak - $g->bpjs, 0, ',', '.') ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->