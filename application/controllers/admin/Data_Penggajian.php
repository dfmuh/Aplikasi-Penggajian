<?php

class Data_Penggajian extends CI_Controller
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
		$data['title'] = "Data Gaji Karyawan";
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
		} else {
			$bulan = date('m');
			$tahun = date('Y');
		}

		$bulan_sebelumnya = $bulan - 1;

		$gaji = $this->db->query("SELECT data_karyawan.nip, data_karyawan.nama_karyawan, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok AS gaji_pokok_jabatan, data_jabatan.tj_penugasan AS tj_penugasan_jabatan, data_jabatan.uang_makan AS uang_makan_jabatan, data_gaji.gaji_pokok AS gaji_pokok_gaji, data_gaji.tj_penugasan AS tj_penugasan_gaji, data_gaji.uang_makan AS uang_makan_gaji, data_absensi.hadir, data_karyawan.tanggal_masuk
			FROM data_karyawan
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_karyawan.jabatan
			INNER JOIN data_absensi ON data_absensi.nip=data_karyawan.nip
			LEFT JOIN data_gaji ON data_gaji.nip=data_karyawan.nip AND data_gaji.bulan = '$bulan' AND data_gaji.tahun = '$tahun'
			WHERE data_absensi.bulan = '$bulan_sebelumnya' AND data_absensi.tahun = '$tahun'
			ORDER BY data_karyawan.nama_karyawan ASC")->result();

		$data['gaji'] = $gaji;

		$data['cek'] = $this->db->query("SELECT nip, bulan, tahun FROM data_gaji")->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/data_gaji', $data);
		$this->load->view('template_admin/footer');
	}



	public function cetak_gaji()
	{

		$data['title'] = "Cetak Data Gaji Karyawan";
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
		} else {
			$bulan = date('m');
			$tahun = date('Y');
		}
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

	public function edit_status($bulan, $tahun, $nip, $gaji_pokok, $tj_penugasan, $uang_makan, $pajak, $bpjs)
	{
		$data = array(
			'bulan' => $bulan,
			'tahun' => $tahun,
			'nip' => $nip,
			'gaji_pokok' => $gaji_pokok,
			'tj_penugasan' => $tj_penugasan,
			'uang_makan' => $uang_makan,
			'pajak' => $pajak,
			'bpjs' => $bpjs
		);

		$this->ModelPenggajian->insert_data($data, 'data_gaji');
		redirect('admin/data_penggajian');
	}
}
