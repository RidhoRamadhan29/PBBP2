<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->model('Dashboard_model', 'dashboard');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->user->getUserData();
        $data['all_user'] = $this->user->getUserDataAll();
        $data['allrole'] = $this->admin->getUserRoleAll();
        $data['data_dashboard'] = $this->user->joinGlobalNokey();
        $data['userx'] = $this->user->getUserDataAll();

        $data['jumlah_pelayanan'] = $this->dashboard->getCountPelayanan();
        $data['jumlah_pendataan'] = $this->dashboard->getCountPendataan();
        $data['jumlah_penetapan'] = $this->dashboard->getCountPenetapan();
        $data['jumlah_penagihan'] = $this->dashboard->getCountPenagihan();
        $data['jumlah_arsip'] = $this->dashboard->getCountArsip();


        $service_dates = $this->dashboard->getServiceDates();
        $monthly_data = array_fill(1, 12, 0);

        foreach ($service_dates as $date) {
            $month = date('n', strtotime($date['tgl_pelayanan']));
            $monthly_data[$month]++;
        }
        $data['monthly_data'] = $monthly_data;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/dashboard', $data);
        $this->load->view('templates/footer');
    }
}
