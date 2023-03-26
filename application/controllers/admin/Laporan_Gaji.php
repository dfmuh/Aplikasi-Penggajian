<?php

class Laporan_Gaji extends CI_Controller
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
		$data['title'] = "Laporan Gaji Karyawan";

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/laporan_gaji');
		$this->load->view('template_admin/footer');
	}

	public function cetak_laporan_gaji()
	{

		$data['title'] = "Cetak Laporan Gaji Karyawan";
		// if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
		// 	$bulan = $this->input->post('bulan');
		// 	$tahun = $this->input->post('tahun');
		// } else {
		// 	$bulan = date('m');
		// 	$tahun = date('Y');
		// }
		// $data['bulan'] = $bulan;
		// $data['tahun'] = $tahun;

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		$data['cetak_gaji'] = $this->db->query("SELECT data_karyawan.nip,data_karyawan.nama_karyawan,
			data_karyawan.jenis_kelamin,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,
			data_jabatan.tj_penugasan,data_jabatan.uang_makan FROM data_karyawan
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
			WHERE DATEDIFF('$tahun-$bulan-01', data_karyawan.tanggal_masuk) > 30
			ORDER BY data_karyawan.nama_karyawan ASC")->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_gaji', $data);
	}
}
