<?php

class Absensi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load database pada model
    }

    public function tambah_absensi($data)
    {
        // Insert data absensi ke dalam tabel absensi
        $this->db->insert('absensi', $data);
    }

    public function ambil_absensi($nip)
    {
        // Ambil data absensi berdasarkan NIP karyawan
        $this->db->where('nip', $nip);
        $query = $this->db->get('absensi');
        return $query->result();
    }
}
