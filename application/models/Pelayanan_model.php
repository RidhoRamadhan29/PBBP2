<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan_model extends CI_Model
{
    public function getAlldataPelayanan()
    {
        $this->db->select('pelayanan.*, user.username, user_role.role');
        $this->db->from('pelayanan');
        $this->db->join('user', 'pelayanan.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        return $this->db->get()->result_array();
    }

    public function getAlldataArsipPelayanan()
    {
        $this->db->select('pelayanan.*, user.username, user_role.role');
        $this->db->from('pelayanan');
        $this->db->join('user', 'pelayanan.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('pelayanan.status_pelayanan', '0');
        return $this->db->get()->result_array();
    }

    public function searchDataPelayanan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_wp', $keyword);
        $this->db->or_like('nik_wp', $keyword);
        return $this->db->get('pelayanan')->result_array();
    }
    public function selecDataPelayanan($id_pelayanan)
    {
        $this->db->where('id_pelayanan', $id_pelayanan);
        return $this->db->get('pelayanan')->row_array();
    }

    public function sqlCountStatus($id_pelayanan)
    {
        $this->db->select('SUM(pelayanan.status_pelayanan + 
        pendataan.status_pendataan + 
        penetapan.status_penetapan + 
        penagihan.status_penagihan + 
        arsip.status_arsip) as total_status');
        $this->db->from('pelayanan');
        $this->db->join('pendataan', 'pelayanan.id_pelayanan = pendataan.id_pelayanan');
        $this->db->join('penetapan', 'pendataan.id_pendataan = penetapan.id_pendataan');
        $this->db->join('penagihan', 'penetapan.id_penetapan = penagihan.id_penetapan');
        $this->db->join('arsip', 'penagihan.id_penagihan = arsip.id_penagihan');
        $this->db->where('pelayanan.id_pelayanan', $id_pelayanan);
        $query = $this->db->get();
        $result = $query->row_array(); // Menggunakan row() karena kita hanya mengharapkan satu baris hasil
        return $result;
    }
}
