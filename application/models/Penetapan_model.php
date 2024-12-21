<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penetapan_model extends CI_Model
{

    public function getAlldataPenetapan()
    {
        $this->db->select('*,pendataan.id_user as pendataan_id_user,penetapan.id_user as penetapan_id_user'); // Pilih semua kolom dari tabel pelayanan dan tambahkan kolom user_id dari tabel pendataan dengan alias
        $this->db->from('penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'penetapan.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        return $this->db->get()->result_array();
    }
    public function searchDataPenetapan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_wp', $keyword);
        $this->db->or_like('nik_wp', $keyword);
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        return $this->db->get('penetapan')->result_array();
    }
}
