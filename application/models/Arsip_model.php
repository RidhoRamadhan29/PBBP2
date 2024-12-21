<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_model extends CI_Model
{

    public function getAlldataArsip()
    {
        $this->db->select('*,penagihan.id_user as penagihan_id_user,arsip.id_user as arsip_id_user');
        $this->db->from('arsip');
        $this->db->join('penagihan', 'arsip.id_penagihan = penagihan.id_penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'arsip.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('penagihan.status_penagihan', '4');
        return $this->db->get()->result_array();
    }

    public function getAlldataArsipPelayanan()
    {
        $this->db->select('*,penagihan.id_user as penagihan_id_user,arsip.id_user as arsip_id_user');
        $this->db->from('arsip');
        $this->db->join('penagihan', 'arsip.id_penagihan = penagihan.id_penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'arsip.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('pelayanan.status_pelayanan', '0');
        return $this->db->get()->result_array();
    }

    public function getAlldataArsipPendataan()
    {
        $this->db->select('*,penagihan.id_user as penagihan_id_user,arsip.id_user as arsip_id_user');
        $this->db->from('arsip');
        $this->db->join('penagihan', 'arsip.id_penagihan = penagihan.id_penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'arsip.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('pelayanan.status_pelayanan', '1');
        $this->db->where('pendataan.status_pendataan', '0');
        return $this->db->get()->result_array();
    }

    public function getAlldataArsipPenetapan()
    {
        $this->db->select('*,penagihan.id_user as penagihan_id_user,arsip.id_user as arsip_id_user');
        $this->db->from('arsip');
        $this->db->join('penagihan', 'arsip.id_penagihan = penagihan.id_penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'arsip.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('pendataan.status_pendataan', '2');
        $this->db->where('penetapan.status_penetapan', '0');
        return $this->db->get()->result_array();
    }

    public function getAlldataArsipPenagihan()
    {
        $this->db->select('*,penagihan.id_user as penagihan_id_user,arsip.id_user as arsip_id_user');
        $this->db->from('arsip');
        $this->db->join('penagihan', 'arsip.id_penagihan = penagihan.id_penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        $this->db->join('user', 'arsip.id_user = user.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('penetapan.status_penetapan', '3');
        $this->db->where('penagihan.status_penagihan', '0');
        return $this->db->get()->result_array();
    }

    public function searchDataArsip()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama_wp', $keyword);
        $this->db->or_like('nik_wp', $keyword);
        $this->db->join('penagihan', 'arsip.id_penagihan = penagihan.id_penagihan');
        $this->db->join('penetapan', 'penagihan.id_penetapan = penetapan.id_penetapan');
        $this->db->join('pendataan', 'penetapan.id_pendataan = pendataan.id_pendataan');
        $this->db->join('pelayanan', 'pendataan.id_pelayanan = pelayanan.id_pelayanan');
        return $this->db->get('arsip')->result_array();
    }
}
