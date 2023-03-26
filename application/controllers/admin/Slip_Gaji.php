<?php

class Slip_Gaji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}
	}

	public function index()
	{
		$data['title'] = "Slip Gaji Karyawan";
		$data['karyawan'] = $this->ModelPenggajian->get_data('data_karyawan')->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/slip_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function cetak_slip_gaji()
	{

		$data['title'] = "Cetak Laporan Absensi Karyawan";
		$nama = $this->input->post('nama_karyawan');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		$data['print_slip'] = $this->db->query("SELECT data_karyawan.nip,data_karyawan.nama_karyawan,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_penugasan,data_jabatan.uang_makan  
		FROM data_karyawan INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
		WHERE DATEDIFF('$tahun-$bulan-01', data_karyawan.tanggal_masuk) > 30 AND data_karyawan.nama_karyawan='$nama'")->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_slip_gaji', $data);
	}
}
