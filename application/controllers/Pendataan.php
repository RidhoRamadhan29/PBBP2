<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pendataan extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Pelayanan_model', 'pelayanan');
        $this->load->model('Pendataan_model', 'pendataan');
    }

    public function index()
    {
        $data['title'] = 'PENDATAAN';
        $data['user'] = $this->user->getUserData();
        $data['all_user'] = $this->user->getUserDataAll();
        $data['allrole'] = $this->admin->getUserRoleAll();
        $data['data_pendataan'] = $this->pendataan->getAlldataPendataan();
        $data['userx'] = $this->user->getUserDataAll();

        if ($this->input->post('keyword')) {
            $data['all_user']  = $this->pendataan->searchDataPendataan();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu_layanan/pendataan/index', $data);
        $this->load->view('templates/footer');
    }

    public function editpendataan()
    {
        $id_pendataan = $this->input->post('id_pendataan');
        $status_pendataan = $this->input->post('status_pendataan');
        $id_user_petugas_pendataan = $this->input->post('id_user');
        $nama_wp = $this->input->post('nama_wp');
        $nik_wp = $this->input->post('nik_wp');
        $alamat = $this->input->post('alamat');
        $nop = $this->input->post('nop');
        $jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
        $alashak = $this->input->post('alashak');
        $joinglobal = $this->user->joinGlobal($id_pendataan);

        //memulai input ke DB
        //=====
        $datapendataan = array(
            'id_user' => $_SESSION['user_id'],
            'status_pendataan' => $status_pendataan,
            'tgl_pendataan' => date('Y-m-d')
        );
        $this->db->where('id_pendataan', $id_pendataan);
        $this->db->update('pendataan', $datapendataan);
        //=====


        // Update penetapan
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_pendataan', $joinglobal['id_pendataan']);
        $this->db->update('penetapan');

        // Update penagihan
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_penetapan', $joinglobal['id_penetapan']);
        $this->db->update('penagihan');

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');

        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message', $id_pendataan . '-' .  $nama_wp . '-' . $nik_wp . '-' . $jenis_pendaftaran . '-' . $alashak . ' Update berhasil.');
        } else {
            $this->session->set_flashdata('error_message', ' Berhasil Mengubah Tetapi Tidak Ada Data Yang Berubah Mohon Dicek Kembali.');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Edit File Kependataan';
        $log_message = 'User Id ' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);
        redirect('pendataan');
    }

    public function pengembalianfile()
    {
        $nilai_pengembalian_ke_pelayanan = $this->input->get('pengembalian_pelayanan');
        $id_pelayanan_di_pendataan = $this->input->get('id_pelayanan_di_pendataan');
        $id_user_petugas_pendataan = $_SESSION['user_id'];

        $joinglobal = $this->user->joinGlobal($id_pelayanan_di_pendataan);
        // Update pelayanan
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->set('status_pelayanan', $nilai_pengembalian_ke_pelayanan);
        $this->db->where('id_pelayanan', $id_pelayanan_di_pendataan);
        $this->db->update('pelayanan');

        // Update pendataan
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_pelayanan', $id_pelayanan_di_pendataan);
        $this->db->update('pendataan');

        // Update penetapan
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_pendataan', $joinglobal['id_pendataan']);
        $this->db->update('penetapan');

        // Update penagihan
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_penetapan', $joinglobal['id_penetapan']);
        $this->db->update('penagihan');

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_pendataan);
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');

        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message',  'ID PELAYANAN ' . $id_pelayanan_di_pendataan . ' Berhasil Update.');
        } else {
            $this->session->set_flashdata('error_message', 'Update GAGAL');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Mengembalikan File Dari Pendataan Ke pelayanan';
        $log_message = 'User Id' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);

        redirect('pendataan');
    }
}
