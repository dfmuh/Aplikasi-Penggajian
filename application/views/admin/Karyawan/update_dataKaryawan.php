<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

</div>
<!-- /.container-fluid -->

<div class="card" style="width: 60% ; margin-bottom: 100px">
	<div class="card-body">

		<?php foreach ($karyawan as $p) : ?>
			<form method="POST" action="<?php echo base_url('admin/data_karyawan/update_data_aksi') ?>" enctype="multipart/form-data">

				<div class="form-group">
					<label>NIP</label>
					<input type="hidden" name="id_karyawan" class="form-control" value="<?php echo $p->id_karyawan ?>">
					<input type="number" name="nip" class="form-control" value="<?php echo $p->nip ?>">
					<?php echo form_error('nip', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Nama Karyawan</label>
					<input type="text" name="nama_karyawan" class="form-control" value="<?php echo $p->nama_karyawan ?>">
					<?php echo form_error('nama_karyawan', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jenis_kelamin" class="form-control" value="<?php echo $p->id_karyawan ?>">
						<option value="<?php echo $p->jenis_kelamin ?>"><?php echo $p->jenis_kelamin ?></option>
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
					<?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Jabatan</label>
					<select name="jabatan" class="form-control">
						<option value="<?php echo $p->jabatan ?>"><?php echo $p->jabatan ?></option>
						<?php foreach ($jabatan as $j) : ?>
							<option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<label>Tanggal Masuk</label>
					<input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $p->tanggal_masuk ?>">
					<?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="<?php echo $p->status ?>"><?php echo $p->status ?></option>
						<option value="Karyawan Tetap">Karyawan Tetap</option>
						<option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
					</select>
					<?php echo form_error('status', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<button type="submit" class="btn btn-success">Simpan</button>
				<a href="<?php echo base_url('admin/data_karyawan') ?>" class="btn btn-warning">Kembali</a>

			</form>
		<?php endforeach; ?>
	</div>
</div>