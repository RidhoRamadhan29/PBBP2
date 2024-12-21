<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penetapan extends CI_Controller
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
    }

    public function index()
    {
        $data['title'] = 'PENETAPAN';
        $data['user'] = $this->user->getUserData();
        $data['all_user'] = $this->user->getUserDataAll();
        $data['allrole'] = $this->admin->getUserRoleAll();
        $data['data_penetapan'] = $this->penetapan->getAlldataPenetapan();
        $data['userx'] = $this->user->getUserDataAll();


        if ($this->input->post('keyword')) {
            $data['all_user']  = $this->penetapan->searchDataPenetapan();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu_layanan/penetapan/index', $data);
        $this->load->view('templates/footer');
    }

    public function editpenetapan()
    {
        $id_penetapan = $this->input->post('id_penetapan');
        $status_penetapan = $this->input->post('status_penetapan');
        $id_user_petugas_penetapan = $this->input->post('id_user');
        $nama_wp = $this->input->post('nama_wp');
        $nik_wp = $this->input->post('nik_wp');
        $alamat = $this->input->post('alamat');
        $nop = $this->input->post('nop');
        $jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
        $alashak = $this->input->post('alashak');
        $joinglobal = $this->user->joinGlobal($id_penetapan);

        //memulai input ke DB
        //=====
        $datapenetapan = array(
            'id_user' => $_SESSION['user_id'],
            'status_penetapan' => $status_penetapan,
            'tgl_penetapan' => date('Y-m-d')
        );
        $this->db->where('id_penetapan', $id_penetapan);
        $this->db->update('penetapan', $datapenetapan);
        //=====


        // Update penagihan
        $this->db->set('id_user', $id_user_petugas_penetapan);
        $this->db->where('id_penetapan', $joinglobal['id_penetapan']);
        $this->db->update('penagihan');

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_penetapan);
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');


        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message', $id_penetapan . '-' .  $nama_wp . '-' . $nik_wp . '-' . $jenis_pendaftaran . '-' . $alashak . ' Update berhasil.');
        } else {
            $this->session->set_flashdata('error_message', ' Berhasil Mengubah Tetapi Tidak Ada Data Yang Berubah Mohon Dicek Kembali.');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Edit File Kepenetapan';
        $log_message = 'User Id ' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);
        redirect('penetapan');
    }

    public function pengembalianfile()
    {
        $nilai_pengembalian_ke_pendataan = $this->input->get('pengembalian_penetapan');
        $id_pendataan_di_penetapan = $this->input->get('id_pendataan_di_penetapan');
        $id_user_petugas_penetapan = $_SESSION['user_id'];

        $joinglobal = $this->user->joinGlobal($id_pendataan_di_penetapan);

        // Update pendataan
        $this->db->set('id_user', $id_user_petugas_penetapan);
        $this->db->set('status_pendataan', $nilai_pengembalian_ke_pendataan);
        $this->db->where('id_pendataan', $id_pendataan_di_penetapan);
        $this->db->update('pendataan');

        // Update penetapan
        $this->db->set('id_user', $id_user_petugas_penetapan);
        $this->db->where('id_pendataan', $joinglobal['id_pendataan']);
        $this->db->update('penetapan');

        // Update penagihan
        $this->db->set('id_user', $id_user_petugas_penetapan);
        $this->db->where('id_penetapan', $joinglobal['id_penetapan']);
        $this->db->update('penagihan');

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_penetapan);
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');

        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message',  'ID PELAYANAN ' . $id_pendataan_di_penetapan . ' Berhasil Update.');
        } else {
            $this->session->set_flashdata('error_message', 'Update GAGAL');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Mengembalikan File Dari Penetapan Ke Pendataan';
        $log_message = 'User Id' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);

        redirect('penetapan');
    }
}
