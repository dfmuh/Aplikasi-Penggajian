<?php

class Absensi extends CI_Controller
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
        $this->load->helper('date_helper');
        $this->load->model('absensi_model'); // Load model absensi_model
    }

    public function index()
    {
        $data['title'] = "Absensi";
        $nip = $this->session->userdata('nip');
        $data['absensi'] = $this->absensi_model->ambil_absensi($nip);

        $this->load->view('template_karyawan/header', $data);
        $this->load->view('template_karyawan/sidebar');
        $this->load->view('karyawan/absensi', $data); // Menggunakan view 'karyawan/absensi' sebagai halaman tampilan absensi
        $this->load->view('template_karyawan/footer');
    }

    public function save_absensi($weekday)
    {
        $data['title'] = "Absensi";
        $tanggal_absensi = $weekday;
        $bulan = date('m', strtotime($tanggal_absensi));
        $tahun = date('Y', strtotime($tanggal_absensi));
        $nip = $this->session->userdata('nip');

        // Mengambil keterangan dari input form
        $keterangan = $this->input->post('keterangan');

        // Mengecek apakah sudah ada data absensi dengan NIP dan tanggal yang sama di database
        $this->db->where('nip', $nip);
        $this->db->where('tanggal_absensi', $tanggal_absensi);
        $query = $this->db->get('absensi');
        $result = $query->row();

        if ($result && !empty($result->keterangan)) {
            // Jika sudah ada data, langsung redirect ke halaman absensi
            redirect('admin/absensi');
        } else if ($result && empty($result->keterangan)) {
            // Jika sudah ada data tetapi keterangan pada database null, update keterangan
            $data = array(
                'keterangan' => $keterangan
            );
            $this->db->where('nip', $nip);
            $this->db->where('tanggal_absensi', $tanggal_absensi);
            $this->db->update('absensi', $data);

            // Kembali ke halaman absensi dengan kolom keterangan yang sudah terisi
            redirect('karyawan/absensi/add_data/' . $nip . '/' . $bulan . '/' . $tahun . '/' . $keterangan);
        } else {
            // Mengecek perbedaan bulan antara tanggal saat ini dan tanggal absensi dalam database
            $this_month = date('m');
            $db_month = date('m', strtotime($tanggal_absensi));
            $month_diff = abs($this_month - $db_month);

            if ($month_diff > 2) {
                // Jika perbedaan bulan lebih dari 2 bulan, hapus semua data absensi dengan bulan yang beda 2 bulan
                $this->db->where('MONTH(tanggal_absensi) !=', $this_month);
                $this->db->delete('absensi');
            }

            // Simpan data absensi ke dalam database
            $data = array(
                'nip' => $nip,
                'tanggal_absensi' => $tanggal_absensi,
                'keterangan' => $keterangan
            );
            $this->db->insert('absensi', $data);

            // Kembali ke halaman absensi dengan kolom keterangan yang sudah terisi
            redirect('karyawan/absensi/add_data/' . $nip . '/' . $bulan . '/' . $tahun . '/' . $keterangan);
        }
    }

    public function form_absensi($weekday)
    {
        $data['title'] = "Isi Absensi";
        // Mengirim data $weekday ke view sebagai variabel $weekday
        $data['weekday'] = $weekday;

        // Tampilkan halaman form absensi
        $this->load->view('template_karyawan/header', $data);
        $this->load->view('template_karyawan/sidebar');
        $this->load->view('karyawan/edit_absensi', $data); // Menggunakan view 'karyawan/edit_absensi' sebagai halaman tampilan absensi
        $this->load->view('template_karyawan/footer');
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

            redirect('karyawan/absensi');
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
            redirect('karyawan/absensi');
        }
    }
}
