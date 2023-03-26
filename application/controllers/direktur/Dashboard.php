<?php

class Dashboard extends CI_Controller
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
		$data['title'] = "Dashboard";
		$id = $this->session->userdata('id_karyawan');
		$data['karyawan'] = $this->db->query("SELECT * FROM data_akses WHERE id_karyawan='$id'")->result();

		$this->load->view('template_direktur/header', $data);
		$this->load->view('template_direktur/sidebar');
		$this->load->view('direktur/dashboard', $data);
		$this->load->view('template_direktur/footer');
	}
}
