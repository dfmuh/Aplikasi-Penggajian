<?php

class data_absensi extends CI_Controller
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

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/data_absensi', $data);
        $this->load->view('template_admin/footer');
    }

    public function add_data($nip, $bulan, $tahun, $keterangan)
    {
        // Cek apakah data sudah ada di database
        $this->db->where('nip', $nip);
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $query = $this->db->get('data_absensi');

        if ($query->num_rows() > 0) {
            // Jika data sudah ada, lakukan update
            $row = $query->row();
            $hadir = $row->hadir;
            $izin = $row->izin;
            $alpha = $row->alpha;

            // Update value pada keterangan yang sesuai
            if ($keterangan == 'Hadir') {
                $hadir++;
            } elseif ($keterangan == 'Izin') {
                $izin++;
            } elseif ($keterangan == 'Alpha') {
                $alpha++;
            }

            // Update data pada database
            $data = array(
                'hadir' => $hadir,
                'izin' => $izin,
                'alpha' => $alpha
            );
            $this->db->where('nip', $nip);
            $this->db->where('bulan', $bulan);
            $this->db->where('tahun', $tahun);
            $this->db->update('data_absensi', $data);

            redirect('admin/absensi');
        } else {
            // Jika data belum ada, lakukan insert
            $data = array(
                'nip' => $nip,
                'bulan' => $bulan,
                'tahun' => $tahun
            );

            // Set value pada keterangan yang sesuai
            if ($keterangan == 'Hadir') {
                $data['hadir'] = 1;
                $data['izin'] = 0;
                $data['alpha'] = 0;
            } elseif ($keterangan == 'Izin') {
                $data['hadir'] = 0;
                $data['izin'] = 1;
                $data['alpha'] = 0;
            } elseif ($keterangan == 'Alpha') {
                $data['hadir'] = 0;
                $data['izin'] = 0;
                $data['alpha'] = 1;
            }

            // Insert data ke database
            $this->db->insert('data_absensi', $data);
            redirect('admin/absensi');
        }
    }
}
