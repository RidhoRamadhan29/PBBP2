<?php
function is_logged_in()
{
    $CI = get_instance();
    if (!$CI->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $CI->session->userdata('role_id');
        //$menu = $CI->uri->segment(1); INI YANG AWAL
        //INI TAMBAHAN KARNA MENU KURANG PAS
        $menux = $CI->uri->segment(1);
        $querysatu = $CI->db->join('user_menu', 'user_menu.id = user_access_menu.menu_id')
            ->join('user_sub_menu', 'user_sub_menu.menu_id = user_access_menu.menu_id')
            ->get_where('user_access_menu', ['role_id' => $role_id, 'url' => $menux])->row_array();

        $menu = $querysatu['menu'];
        //TAMBAHAN SAMPAI SINI
        $queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $CI->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $CI = get_instance();
    $CI->db->where('role_id', $role_id);
    $CI->db->where('menu_id', $menu_id);
    $result = $CI->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function active_check($is_active, $submenu_id)
{
    $CI = get_instance();
    $CI->db->where('is_active', $is_active);
    $CI->db->where('id', $submenu_id);
    $result = $CI->db->get('user_sub_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
