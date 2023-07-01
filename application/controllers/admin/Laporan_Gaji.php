<?php

class Laporan_Gaji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') != '2') {
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

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		// Mengambil data gaji berdasarkan nip, bulan, dan tahun
		$data['cetak_gaji'] = $this->db->query("SELECT data_gaji.nip, data_karyawan.nama_karyawan,
			data_karyawan.jenis_kelamin, data_jabatan.nama_jabatan, data_gaji.gaji_pokok,
			data_gaji.tj_penugasan, data_gaji.uang_makan, data_gaji.pajak, data_gaji.bpjs FROM data_gaji
			INNER JOIN data_karyawan ON data_gaji.nip = data_karyawan.nip
			INNER JOIN data_jabatan ON data_karyawan.jabatan = data_jabatan.nama_jabatan
			WHERE data_gaji.bulan = '$bulan' AND data_gaji.tahun = '$tahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_gaji', $data);
	}
}
