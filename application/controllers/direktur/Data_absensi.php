<?php

class data_absensi extends CI_Controller
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
        $data['title'] = "Data Absensi";
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }
        $data['absensi'] = $this->db->query("SELECT data_absensi.*, data_karyawan.nama_karyawan 
        FROM data_absensi 
        INNER JOIN data_karyawan ON data_karyawan.nip = data_absensi.nip 
        WHERE data_absensi.bulan = '$bulan' AND data_absensi.tahun = '$tahun' 
        ORDER BY data_absensi.nip ASC")->result();

        $this->load->view('template_direktur/header', $data);
        $this->load->view('template_direktur/sidebar');
        $this->load->view('direktur/data_absensi', $data);
        $this->load->view('template_direktur/footer');
    }
}
