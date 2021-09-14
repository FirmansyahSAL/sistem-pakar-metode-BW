<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jabatan extends CI_Model
{
    public $id = 'id_jabatan';

    function get_jabatan()
    {
        return $this->db->get('jabatan')->result();
    }

    function get_id_jabatan($id)
    {
        $this->db->where('id_jabatan', $id);
        return $this->db->get('jabatan')->row();
    }

    function insert($data)
    {
        $this->db->insert('jabatan', $data);
    }

    function update($id, $data)
    {
        $this->db->where('id_jabatan', $id);
        $this->db->update('jabatan', $data);
    }

    function delete($id)
    {
        $this->db->where('id_jabatan', $id);
        $this->db->delete('jabatan');
    }
}
