<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
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
        $this->load->model('Arsip_model', 'arsip');
    }

    public function index()
    {
        $data['title'] = 'ARSIP';
        $data['user'] = $this->user->getUserData();
        $data['all_user'] = $this->user->getUserDataAll();
        $data['allrole'] = $this->admin->getUserRoleAll();
        $data['data_arsip'] = $this->arsip->getAlldataArsip();

        $data['data_pelayanan'] = $this->arsip->getAlldataArsipPelayanan();
        $data['data_pendataan'] = $this->arsip->getAlldataArsipPendataan();
        $data['data_penetapan'] = $this->arsip->getAlldataArsipPenetapan();
        $data['data_penagihan'] = $this->arsip->getAlldataArsipPenagihan();

        $data['userx'] = $this->user->getUserDataAll();


        if ($this->input->post('keyword')) {
            $data['all_user']  = $this->arsip->searchDataArsip();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu_layanan/arsip/index', $data);
        $this->load->view('templates/footer');
    }
}
