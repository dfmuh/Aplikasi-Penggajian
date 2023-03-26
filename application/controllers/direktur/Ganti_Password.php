<?php

class Ganti_Password extends CI_Controller
{

	public function index()
	{
		$data['title'] = "Form Ganti Password";

		$this->load->view('template_direktur/header', $data);
		$this->load->view('template_direktur/sidebar');
		$this->load->view('direktur/ganti_password', $data);
		$this->load->view('template_direktur/footer');
	}

	public function ganti_password_aksi()
	{
		$passBaru = $this->input->post('passBaru');
		$ulangPass = $this->input->post('ulangPass');

		$this->form_validation->set_rules('passBaru', 'Password Baru', 'required');
		$this->form_validation->set_rules('ulangPass', 'Ulangi Password Baru', 'required|matches[passBaru]', array('matches' => ''));

		if ($this->form_validation->run() != FALSE) {
			$data = array('password' => md5($passBaru));
			$id = array('id_karyawan' => $this->session->userdata('id_karyawan'));
			$this->ModelPenggajian->update_data('data_akses', $data, $id);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Password berhasil diganti!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		} else {
			$data['title'] = "Form Ganti Password";
			$data['error'] = 'Password tidak sama, silahkan masukkan kembali';

			$this->load->view('template_direktur/header', $data);
			$this->load->view('template_direktur/sidebar');
			$this->load->view('direktur/ganti_password', $data);
			$this->load->view('template_direktur/footer');
		}
	}
}
