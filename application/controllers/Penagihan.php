<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penagihan extends CI_Controller
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
        $this->load->model('Penetapan_model', 'penetapan');
        $this->load->model('Penagihan_model', 'penagihan');
    }

    public function index()
    {
        $data['title'] = 'PENAGIHAN';
        $data['user'] = $this->user->getUserData();
        $data['all_user'] = $this->user->getUserDataAll();
        $data['allrole'] = $this->admin->getUserRoleAll();
        $data['data_penagihan'] = $this->penagihan->getAlldataPenagihan();
        $data['userx'] = $this->user->getUserDataAll();


        if ($this->input->post('keyword')) {
            $data['all_user']  = $this->penagihan->searchDataPenagihan();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu_layanan/penagihan/index', $data);
        $this->load->view('templates/footer');
    }

    public function editpenagihan()
    {
        $id_penagihan = $this->input->post('id_penagihan');
        $status_penagihan = $this->input->post('status_penagihan');
        $id_user_petugas_penagihan = $this->input->post('id_user');
        $nama_wp = $this->input->post('nama_wp');
        $nik_wp = $this->input->post('nik_wp');
        $alamat = $this->input->post('alamat');
        $nop = $this->input->post('nop');
        $jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
        $alashak = $this->input->post('alashak');
        $joinglobal = $this->user->joinGlobal($id_penagihan);

        //memulai input ke DB
        //=====
        $datapenagihan = array(
            'id_user' => $_SESSION['user_id'],
            'status_penagihan' => $status_penagihan,
            'tgl_penagihan' => date('Y-m-d')
        );
        $this->db->where('id_penagihan', $id_penagihan);
        $this->db->update('penagihan', $datapenagihan);
        //=====

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_penagihan);
        $this->db->set('tgl_arsip', date('Y-m-d'));
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');

        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message', $id_penagihan . '-' .  $nama_wp . '-' . $nik_wp . '-' . $jenis_pendaftaran . '-' . $alashak . ' BERHASIL DI ARSIPKAN !!!!.');
        } else {
            $this->session->set_flashdata('error_message', ' Berhasil Mengubah Tetapi Tidak Ada Data Yang Berubah Mohon Dicek Kembali.');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Edit File Kepenagihan';
        $log_message = 'User Id ' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);
        redirect('penagihan');
    }

    public function pengembalianfile()
    {
        $nilai_pengembalian_ke_penetapan = $this->input->get('pengembalian_penagihan');
        $id_penetapan_di_penagihan = $this->input->get('id_penetapan_di_penagihan');
        $id_user_petugas_penagihan = $_SESSION['user_id'];

        $joinglobal = $this->user->joinGlobal($id_penetapan_di_penagihan);

        // Update penetapan
        $this->db->set('id_user', $id_user_petugas_penagihan);
        $this->db->set('status_penetapan', $nilai_pengembalian_ke_penetapan);
        $this->db->where('id_penetapan', $id_penetapan_di_penagihan);
        $this->db->update('penetapan');

        // Update penagihan
        $this->db->set('id_user', $id_user_petugas_penagihan);
        $this->db->where('id_penetapan', $joinglobal['id_penetapan']);
        $this->db->update('penagihan');

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_penagihan);
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');

        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message',  'ID PENAGIHAN ' . $id_penetapan_di_penagihan . ' Berhasil Update.');
        } else {
            $this->session->set_flashdata('error_message', 'Update GAGAL');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Mengembalikan File Dari Penagihan Ke Penetapan';
        $log_message = 'User Id' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);

        redirect('penagihan');
    }
}
