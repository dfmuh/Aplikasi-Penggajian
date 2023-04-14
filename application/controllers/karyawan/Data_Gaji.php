<?php

class Data_Gaji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') != '3') {
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
		$data['title'] = "Data Gaji";
		$nip = $this->session->userdata('nip');
		$year = date('Y'); // Mendapatkan tahun saat ini

		$data['gaji'] = $this->db->query("SELECT data_karyawan.nama_karyawan, data_karyawan.nip,
			data_gaji.gaji_pokok, data_gaji.tj_penugasan, data_gaji.uang_makan, data_gaji.bulan, data_gaji.tahun
			FROM data_karyawan
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_karyawan.jabatan
			INNER JOIN data_gaji ON data_gaji.nip = data_karyawan.nip
			WHERE data_karyawan.nip = '$nip' AND data_gaji.nip = '$nip' AND data_gaji.tahun = '$year'
			ORDER BY data_gaji.bulan ASC")->result();



		$this->load->view('template_karyawan/header', $data);
		$this->load->view('template_karyawan/sidebar');
		$this->load->view('karyawan/data_gaji', $data);
		$this->load->view('template_karyawan/footer');
	}

	public function cetak_slip($id)
	{
		$data['title'] = 'Cetak Slip Gaji';
		// $data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();

		$data['print_slip'] = $this->db->query("SELECT data_karyawan.nip,data_karyawan.nama_karyawan,data_jabatan.nama_jabatan,data_jabatan.gaji_pokok,data_jabatan.tj_transport,data_jabatan.uang_makan,data_kehadiran.alpha,data_kehadiran.bulan
			FROM data_karyawan
			INNER JOIN data_kehadiran ON data_kehadiran.nip=data_karyawan.nip
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
			WHERE data_kehadiran.id_kehadiran = '$id'")->result();
		$this->load->view('template_karyawan/header', $data);
		$this->load->view('karyawan/cetak_slip_gaji', $data);
	}
}
