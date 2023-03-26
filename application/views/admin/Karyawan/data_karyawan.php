<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>
  <a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/data_karyawan/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Karyawan</a>
  <?php echo $this->session->flashdata('pesan') ?>
</div>

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
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Jabatan</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($karyawan as $p) : ?>
              <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $p->nip ?></td>
                <td class="text-center"><?php echo $p->nama_karyawan ?></td>
                <td class="text-center"><?php echo $p->jenis_kelamin ?></td>
                <td class="text-center"><?php echo $p->jabatan ?></td>
                <td class="text-center"><?php echo $p->tanggal_masuk ?></td>
                <td class="text-center"><?php echo $p->status ?></td>
                <td>
                  <center>
                    <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/data_karyawan/update_data/' . $p->id_karyawan) ?>"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_karyawan/delete_data/' . $p->id_karyawan) ?>"><i class="fas fa-trash"></i></a>
                  </center>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>