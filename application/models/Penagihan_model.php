<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penagihan_model extends CI_Model
{

    public function getAlldataPenagihan()
    {
        $this->db->select('*,penetapan.id_user as penetapan_id_user,penagihan.id_user as penagihan_id_user');
        $this->db->from('penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'penagihan.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        return $this->db->get()->result_array();
    }
    public function searchDataPenagihan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_wp', $keyword);
        $this->db->or_like('nik_wp', $keyword);
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        return $this->db->get('penagihan')->result_array();
    }
}
