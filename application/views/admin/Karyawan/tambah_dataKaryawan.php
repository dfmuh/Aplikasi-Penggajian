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
		<form method="POST" action="<?php echo base_url('admin/data_karyawan/tambah_data_aksi') ?>" enctype="multipart/form-data">

			<div class="form-group">
				<label>NIP</label>
				<input type="number" name="nik" class="form-control">
				<?php echo form_error('nik', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Nama Karyawan</label>
				<input type="text" name="nama_karyawan" class="form-control">
				<?php echo form_error('nama_karyawan', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="jenis_kelamin" class="form-control">
					<option value="">--Pilih Jenis Kelamin--</option>
					<option value="Laki-Laki">Laki-Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				<?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Jabatan</label>
				<select name="jabatan" class="form-control">
					<option value="">--Pilih Jabatan--</option>
					<?php foreach ($jabatan as $j) : ?>
						<option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Tanggal Masuk</label>
				<input type="date" name="tanggal_masuk" class="form-control">
				<?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option value="">--Pilih Status--</option>
					<option value="Karyawan Tetap">Karyawan Tetap</option>
					<option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
				</select>
				<?php echo form_error('status', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<button type="submit" class="btn btn-success">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>
			<a href="<?php echo base_url('admin/data_karyawan') ?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>