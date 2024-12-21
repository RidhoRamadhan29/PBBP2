<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    // Users Data
    public function getUserData()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('user.email', $this->session->userdata('email'));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getUserDataTwo($id_user)
    {
        $query = $this->db->get_where('user', ['id' => $id_user]);
        return $query->row_array();
    }
    public function getUserDataAll()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }
    public function getUserDataAllPelayanan()
    {
        $query = $this->db->get('user');
        return $query;
    }

    // Login
    public function userCheckLogin($username)
    {
        $this->db->where("email =  '$username' or username =  '$username'");
        $query = $this->db->get('user');
        return $query->row_array();
    }
    public function joinGlobal($key)
    {
        $this->db->select('*');
        $this->db->from('pelayanan');
        $this->db->join('pendataan', 'pelayanan.id_pelayanan = pendataan.id_pelayanan');
        $this->db->join('penetapan', 'pendataan.id_pendataan = penetapan.id_pendataan');
        $this->db->join('penagihan', 'penetapan.id_penetapan = penagihan.id_penetapan');
        $this->db->join('arsip', 'penagihan.id_penagihan = arsip.id_penagihan');
        $this->db->where('pelayanan.id_pelayanan', $key)
            ->or_where_in('pendataan.id_pendataan', $key)
            ->or_where_in('penetapan.id_penetapan', $key)
            ->or_where_in('penagihan.id_penagihan', $key)
            ->or_where_in('arsip.id_arsip', $key);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function joinGlobalNokey()
    {
        $this->db->select('*');
        $this->db->from('pelayanan');
        $this->db->join('pendataan', 'pelayanan.id_pelayanan = pendataan.id_pelayanan');
        $this->db->join('penetapan', 'pendataan.id_pendataan = penetapan.id_pendataan');
        $this->db->join('penagihan', 'penetapan.id_penetapan = penagihan.id_penetapan');
        $this->db->join('arsip', 'penagihan.id_penagihan = arsip.id_penagihan');
        $query = $this->db->get();
        return $query->row_array();
    }
}
