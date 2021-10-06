<?php
defined('BASEPATH') or exit('No direct script access allowed');


function cek_login()
{
    $CI = &get_instance();
    $email = $CI->session->email;

    if ($email == NULL) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Anda harus Login</div>');


        redirect('auth/login');
    }
}

function is_it()
{
    $CI = &get_instance();
    $tipeuser = $CI->session->level_user;

    if ($tipeuser == '2') {
        return $tipeuser;
    }
    return null;
}

function check_relasi($kerusakan_id, $gejala_id)
{
    $ci = get_instance();

    $ci->db->where('kerusakan_id', $kerusakan_id);
    $ci->db->where('gejala_id', $gejala_id);
    $result = $ci->db->get('relasi');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
