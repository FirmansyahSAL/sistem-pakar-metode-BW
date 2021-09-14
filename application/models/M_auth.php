<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{

    public $id = 'id_users';

    function insert($data)
    {

        $this->db->insert('users', $data);
    }

    function get_email_user($id)
    {
        $this->db->where('email', $id);
        return $this->db->get('users')->row();
    }
}
