<?php

class Potongan_model extends CI_Model
{

    public function get_pengaturan_potongan()
    {
        // Ambil data pengaturan potongan dari tabel potongan
        $this->db->select('jabatan, potongan');
        $this->db->from('potongan');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_potongan($jabatan, $potongan)
    {
        // Update potongan berdasarkan jabatan
        $data = array('potongan' => $potongan);
        $this->db->where('jabatan', $jabatan);
        $this->db->update('potongan', $data);
        return $this->db->affected_rows() > 0;
    }

    public function hapus_potongan($jabatan)
    {
        // Hapus potongan berdasarkan jabatan
        $this->db->where('jabatan', $jabatan);
        $this->db->delete('potongan');
        return $this->db->affected_rows() > 0;
    }
}
