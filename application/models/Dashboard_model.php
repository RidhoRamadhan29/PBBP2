<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getServiceDates()
    {
        $this->db->select('tgl_pelayanan');
        $query = $this->db->get('pelayanan');
        return $query->result_array(); // Return an array of service dates
    }

    public function getCountPelayanan()
    {
        $this->db->select('status_pelayanan, COUNT(*) AS jumlah_data');
        $this->db->from('pelayanan');
        $this->db->where('status_pelayanan', '0');
        $query = $this->db->get();
        $jumlah_data = $query->row_array();
        return $jumlah_data;
    }
    public function getCountPendataan()
    {
        $this->db->select('status_pelayanan, COUNT(*) AS jumlah_data');
        $this->db->from('pelayanan');
        $this->db->join('pendataan', 'pelayanan.id_pelayanan = pendataan.id_pelayanan');
        $this->db->where('status_pelayanan', '1');
        $this->db->where('status_pendataan', '0');
        $query = $this->db->get();
        $jumlah_data = $query->row_array();
        return $jumlah_data;
    }
    public function getCountPenetapan()
    {
        $this->db->select('status_pendataan, COUNT(*) AS jumlah_data');
        $this->db->from('pendataan');
        $this->db->join('penetapan', 'pendataan.id_pendataan = penetapan.id_pendataan');
        $this->db->where('status_pendataan', '2');
        $this->db->where('status_penetapan', '0');
        $query = $this->db->get();
        $jumlah_data = $query->row_array();
        return $jumlah_data;
    }
    public function getCountPenagihan()
    {
        $this->db->select('status_penetapan, COUNT(*) AS jumlah_data');
        $this->db->from('penetapan');
        $this->db->join('penagihan', 'penetapan.id_penetapan = penagihan.id_penetapan');
        $this->db->where('status_penetapan', '3');
        $this->db->where('status_penagihan', '0');
        $query = $this->db->get();
        $jumlah_data = $query->row_array();
        return $jumlah_data;
    }
    public function getCountArsip()
    {
        $this->db->select('status_penagihan, COUNT(*) AS jumlah_data');
        $this->db->from('penagihan');
        $this->db->join('arsip', 'penagihan.id_penagihan = arsip.id_penagihan');
        $this->db->where('status_penagihan', '4');
        $this->db->where('status_arsip', '0');
        $query = $this->db->get();
        $jumlah_data = $query->row_array();
        return $jumlah_data;
    }
}
