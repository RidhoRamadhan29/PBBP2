<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        is_logged_in();

        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Pelayanan_model', 'pelayanan');
    }

    public function index()
    {
        $data['title'] = 'PELAYANAN';
        $data['data_pelayanan'] = $this->pelayanan->getAlldataPelayanan();
        $data['user'] = $this->user->getUserData();
        $data['userx'] = $this->user->getUserDataAll();


        if ($this->input->post('keyword')) {
            $data['data_pelayanan']  = $this->pelayanan->searchDataPelayanan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu_layanan/pelayanan/index', $data);
        $this->load->view('templates/footer');
    }

    public function addnewpelayanan()
    {
        $id_user_petugas_pelayanan = $this->input->post('id_user');
        $name_petugas_pelayanan = $this->input->post('name');
        $nama_wp = $this->input->post('nama_wp');
        $nik_wp = $this->input->post('nik_wp');
        $alamat = $this->input->post('alamat');
        $nop = $this->input->post('nop');
        $jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
        $alashak = $this->input->post('alashak');
        // $status_pelayanan = $this->input->post('status_pelayanan');


        // Tentukan direktori tempat Anda akan menyimpan file yang diunggah
        $upload_path = "./file_pbb";

        $random_filename = uniqid();
        $current_date = date('Y-m-d');

        // Konfigurasi upload file
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'pdf|docx';
        $config['max_size'] = 2048; // 2MB maksimum
        $config['file_name'] = "'$nama_wp'-'$nik_wp'-'$random_filename'-'$current_date'";

        //proses perubahan config
        $this->load->library('upload', $config);
        // Inisialisasi konfigurasi upload
        $this->upload->initialize($config);

        // Lakukan proses upload
        if ($this->upload->do_upload('upload_doc_pbb')) {
            // Jika upload berhasil
            $upload_data = $this->upload->data();
        } else {
            // Jika upload gagal
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error_message',  $error . ' Maaf, hanya file PDF dan DOCX yang diizinkan.');
            redirect('pelayanan');
        }

        //memulai input ke DB
        //=====
        $namafilebaru = $upload_data['file_name'];
        $datapelayanan = array(
            'id_user' => $id_user_petugas_pelayanan,
            'nama_wp' => $nama_wp,
            'nik_wp' => $nik_wp,
            'alamat' => $alamat,
            'nop' => $nop,
            'jenis_pendaftaran' => $jenis_pendaftaran,
            'alashak' => $alashak,
            'upload_doc_pbb' => $namafilebaru,
            'status_pelayanan' => '0',
            'tgl_pelayanan' => date('Y-m-d')

        );
        $this->db->insert('pelayanan', $datapelayanan);
        //=====

        $getidpelayanan = $this->db->insert_id();
        $cekidpelayanan = $this->db->get_where('pelayanan', ['id_pelayanan' => $getidpelayanan])->row_array();
        $datapendataan = array(
            'id_pelayanan' => $cekidpelayanan['id_pelayanan'],
            'id_user' => $id_user_petugas_pelayanan,
            'status_pendataan' => '0',
            'tgl_pendataan' => date('Y-m-d')
        );
        $this->db->insert('pendataan', $datapendataan);
        //====

        $getidpendataan = $this->db->insert_id();
        $cekidpendataan = $this->db->get_where('pendataan', ['id_pendataan' => $getidpendataan])->row_array();
        $datapenetapan = array(
            'id_user' => $id_user_petugas_pelayanan,
            'id_pendataan' => $cekidpendataan['id_pendataan'],
            'status_penetapan' => '0',
            'tgl_penetapan' => date('Y-m-d')
        );
        $this->db->insert('penetapan', $datapenetapan);
        //====

        $getidpenetapan = $this->db->insert_id();
        $cekidpenetapan = $this->db->get_where('penetapan', ['id_penetapan' => $getidpenetapan])->row_array();
        $datapenagihan = array(
            'id_penetapan' => $cekidpenetapan['id_penetapan'],
            'id_user' => $id_user_petugas_pelayanan,
            'status_penagihan' => '0',
            'tgl_penagihan' => date('Y-m-d')
        );
        $this->db->insert('penagihan', $datapenagihan);
        //====

        $getidpenagihan = $this->db->insert_id();
        $cekidpenagihan = $this->db->get_where('penagihan', ['id_penagihan' => $getidpenagihan])->row_array();
        $dataarsip = array(
            'id_penagihan' => $cekidpenagihan['id_penagihan'],
            'id_user' => $id_user_petugas_pelayanan,
            'status_arsip' => '0',
            'tgl_arsip' => date('Y-m-d')
        );
        $this->db->insert('arsip', $dataarsip);

        $this->session->set_flashdata('success_message', $upload_data['file_name'] . ' Berhasil Di Input.');
        $activity = 'Menambahkan Baru Data Pelayanan';
        $log_message = 'User Id' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);

        redirect('pelayanan');
    }

    public function editpelayanan()
    {
        $id_pelayanan = $this->input->post('id_pelayanan');
        $id_user_petugas_pelayanan = $this->input->post('id_user');
        $name_petugas_pelayanan = $this->input->post('name');
        $nama_wp = $this->input->post('nama_wp');
        $nik_wp = $this->input->post('nik_wp');
        $alamat = $this->input->post('alamat');
        $nop = $this->input->post('nop');
        $jenis_pendaftaran = $this->input->post('jenis_pendaftaran');
        $alashak = $this->input->post('alashak');
        $status_pelayananx = $this->input->post('status_pelayanan');
        $status_pelayanan = isset($status_pelayananx) ? $status_pelayananx : 0;
        $nama_baru_atau_tidak = $_FILES['upload_doc_pbb']['name'];
        $datalama = $this->pelayanan->selecDataPelayanan($id_pelayanan);

        $joinglobal = $this->user->joinGlobal($id_pelayanan);

        if ($nama_baru_atau_tidak == null || $nama_baru_atau_tidak == '0' || $nama_baru_atau_tidak == '') {
            $namafilebaru = $datalama['upload_doc_pbb'];
        } else {
            // Tentukan direktori tempat Anda akan menyimpan file yang diunggah
            $upload_path = "./file_pbb";

            $random_filename = uniqid();
            $current_date = date('Y-m-d');

            // Konfigurasi upload file
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'pdf|docx';
            $config['max_size'] = 2048; // 2MB maksimum
            $config['file_name'] = "'$nama_wp'-'$nik_wp'-'$random_filename'-'$current_date'";

            //proses perubahan config
            $this->load->library('upload', $config);
            // Inisialisasi konfigurasi upload
            $this->upload->initialize($config);

            // Lakukan proses upload
            //Proses unlink terlebih Dahulu
            $namafilelama = $this->pelayanan->selecDataPelayanan($id_pelayanan);
            $filepathunlink = $upload_path . '/' . $namafilelama['upload_doc_pbb'];

            if (file_exists($filepathunlink)) {
                // Hapus file yang telah ada
                if (unlink($filepathunlink)) {
                    // echo 'File berhasil dihapus.';
                } else {
                    $this->session->set_flashdata('error_message', 'Maaf File Gagal Di Hapus');
                    redirect('pelayanan');
                }
            } else {
                $this->session->set_flashdata('error_message', 'Maaf File Tidak Di Temukan Gagal Di Hapus');
                redirect('pelayanan');
            }
            if ($this->upload->do_upload('upload_doc_pbb')) {
                // Jika upload berhasil
                $upload_data = $this->upload->data();
            } else {
                // Jika upload gagal
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error_message', $error . ' Maaf, hanya file PDF dan DOCX yang diizinkan.');
                redirect('pelayanan');
            }
            $namafilebaru = $upload_data['file_name'];
        }

        //memulai input ke DB
        //=====

        $datapelayanan = array(
            'id_user' => $id_user_petugas_pelayanan,
            'nama_wp' => $nama_wp,
            'nik_wp' => $nik_wp,
            'alamat' => $alamat,
            'nop' => $nop,
            'jenis_pendaftaran' => $jenis_pendaftaran,
            'alashak' => $alashak,
            'upload_doc_pbb' => $namafilebaru,
            'status_pelayanan' => $status_pelayanan
        );
        $this->db->where('id_pelayanan', $id_pelayanan);
        $this->db->update('pelayanan', $datapelayanan);
        //=====

        // Update pendataan
        $this->db->set('id_user', $id_user_petugas_pelayanan);
        $this->db->where('id_pelayanan', $joinglobal['id_pelayanan']);
        $this->db->update('pendataan');

        // Update penetapan
        $this->db->set('id_user', $id_user_petugas_pelayanan);
        $this->db->where('id_pendataan', $joinglobal['id_pendataan']);
        $this->db->update('penetapan');

        // Update penagihan
        $this->db->set('id_user', $id_user_petugas_pelayanan);
        $this->db->where('id_penetapan', $joinglobal['id_penetapan']);
        $this->db->update('penagihan');

        // Update arsip
        $this->db->set('id_user', $id_user_petugas_pelayanan);
        $this->db->where('id_penagihan', $joinglobal['id_penagihan']);
        $this->db->update('arsip');

        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('success_message', $id_pelayanan . '-' .  $nama_wp . '-' . $nik_wp . '-' . $jenis_pendaftaran . '-' . $alashak . ' Update berhasil.');
        } else {
            $this->session->set_flashdata('error_message', ' Berhasil Mengubah Tetapi Tidak Ada Data Yang Berubah Mohon Dicek Kembali.');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $id_pelayanan .'-' .  $nama_wp .'-'. $nik_wp. '-'. $jenis_pendaftaran .'-'. $alashak . ' Berhasil Di Ubah.</div>');
        }
        $activity = 'Edit File Kepelayanan';
        $log_message = 'User Id' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);
        redirect('pelayanan');
    }

    public function deletepelayanan($id_pelayanan)
    {
        $getDataPelyanan = $this->pelayanan->selecDataPelayanan($id_pelayanan);
        $this->db->delete('pelayanan', ['id_pelayanan' => $id_pelayanan]);
        $this->session->set_flashdata('success_message', $getDataPelyanan['id_pelayanan'] . ' Arsip Pelayanan Dihapus!');
        $activity = 'Delete File Kepelayanan';
        $log_message = 'User Id' . $this->session->userdata('user_id') . ' dengan nama (' . $this->session->userdata('username') . ') telah melakukan aktivitas: ' . $activity;
        log_message('error', $log_message);
        redirect('pelayanan');
    }
}
