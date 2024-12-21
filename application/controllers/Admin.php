<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Menu User';
        $data['user'] = $this->user->getUserData();
        $data['all_user'] = $this->user->getUserDataAll();
        $data['allrole'] = $this->admin->getUserRoleAll();

        if ($this->input->post('keyword')) {
            $data['all_user']  = $this->admin->searchUserData();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->user->getUserData();

        $data['role'] = $this->admin->getUserRoleAll();

        $this->form_validation->set_rules('role', 'Role Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $role_name = $this->input->post('role');
            $data = [
                'role' => $role_name
            ];
            $user_role = $this->db->get_where('user_role', ['role' => $role_name]);

            if ($user_role->num_rows() < 1) {
                $this->db->insert('user_role', $data);
                $this->session->set_flashdata('success_message', 'New Role Added!');
                redirect('admin/role');
            } else {
                $this->session->set_flashdata('error_message', 'This role is exist!');
                redirect('admin/role');
            }
        }
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->user->getUserData();


        $data['role'] = $this->admin->getUserRoleById($role_id);

        $data['menu'] = $this->menu->getUserMenuAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('success_message', 'Access Changed!');
    }

    public function addnewuser()
    {
        $nama = $this->input->post('name');
        $email = $this->input->post('email');
        $namauser = $this->input->post('username');
        $password = $this->input->post('password');

        $datauser = array(
            'name' => $nama,
            'email' => $email,
            'username' => $namauser,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'is_active' => '1',
            'image' => 'default.jpg',
            'role_id' => '2',
            'date_created' => date('Y-m-d')

        );
        $this->db->insert('user', $datauser);

        redirect('admin');
    }
    public function editrole($role_id)
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->user->getUserData();
        $data['role'] = $this->admin->getUserRoleById($role_id);;

        $this->form_validation->set_rules('role', 'Role Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-role', $data);
            $this->load->view('templates/footer');
        } else {
            $role_name = $this->input->post('role');
            $user_role = $this->db->get_where('user_role', ['role' => $role_name]);
            if ($user_role->num_rows() < 1) {
                $this->db->set('role', $role_name);
                $this->db->where('id', $role_id);
                $this->db->update('user_role');
                $this->session->set_flashdata('success_message', 'Edit Role Success!');
                redirect('admin/role/');
            } else {
                $this->session->set_flashdata('error_message', 'This role name is exist or same!');
                redirect('admin/editrole/' . $role_id);
            }
        }
    }

    public function deleterole($role_id)
    {
        $role = $this->admin->getUserRoleById($role_id);

        $this->db->delete('user_role', ['id' => $role_id]);
        $this->session->set_flashdata('success_message', $role['role'] . ' role is deleted!');
        redirect('admin/role');
    }

    public function deleteuser($id_user)
    {
        $getdatauser = $this->user->getUserDataTwo($id_user);
        $this->db->delete('user', ['id' => $id_user]);
        $this->session->set_flashdata('success_message', $getdatauser['username'] . ' User Di Hapus!');
        redirect('admin');
    }


    public function editusers()
    {
        $username = $this->input->post('username');
        $name = $this->input->post('name');
        $role_id = $this->input->post('role_id');
        $id_user = $this->input->post('id_user');

        $this->db->set('role_id', $role_id);
        $this->db->set('name', $name);
        $this->db->where('id', $id_user);
        $this->db->update('user');
        $this->session->set_flashdata('success_message', 'Edit User Success!');
        redirect('admin');
    }
}
