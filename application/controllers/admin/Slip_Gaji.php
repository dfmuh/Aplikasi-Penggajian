<?php

class Slip_Gaji extends CI_Controller
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
		$data['title'] = "Slip Gaji Karyawan";
		$data['karyawan'] = $this->ModelPenggajian->get_data('data_karyawan')->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/slip_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function cetak_slip_gaji()
	{
		$data['title'] = "Cetak Slip Gaji";
		$nama = $this->input->post('nama_karyawan');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		$data['print_slip'] = $this->db->query("SELECT data_karyawan.nip, data_karyawan.nama_karyawan,
			data_jabatan.nama_jabatan, data_gaji.gaji_pokok, data_gaji.tj_penugasan, data_gaji.uang_makan
			FROM data_karyawan
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
			INNER JOIN data_gaji ON data_gaji.nip=data_karyawan.nip
			WHERE data_karyawan.nama_karyawan='$nama' AND data_gaji.bulan = '$bulan' AND data_gaji.tahun = '$tahun'
			LIMIT 1")->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_slip_gaji', $data);
	}
}
