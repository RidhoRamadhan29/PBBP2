<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendataan_model extends CI_Model
{
    public function getAlldataPendataan()
    {
        $this->db->select('*,pelayanan.id_user as pelayanan_id_user,pendataan.id_user as pendataan_id_user'); // Pilih semua kolom dari tabel pelayanan dan tambahkan kolom user_id dari tabel pendataan dengan alias
        $this->db->from('pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'pendataan.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        return $this->db->get()->result_array();
    }
    public function searchDataPendataan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_wp', $keyword);
        $this->db->or_like('nik_wp', $keyword);
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        return $this->db->get('pendataan')->result_array();
    }
 

    
}
