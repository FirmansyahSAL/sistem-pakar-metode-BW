<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_karyawan extends CI_Model
{

    function get_karyawan()
    {
        return $this->db->get('users')->result();
    }

    public function get_data_gambar($tabel, $username)
    {
        $query = $this->db->select()
            ->from($tabel)
            ->where('username', $username)
            ->get();
        return $query->result();
    }

    function insert($data)
    {
        $this->db->insert('users', $data);
    }

    function get_id_user($id)
    {
        $this->db->where('id_users', $id);
        return $this->db->get('users')->row();
    }

    function update($id, $data)
    {
        $this->db->where('id_users', $id);
        $this->db->update('users', $data);
    }

    function delete($id)
    {
        $this->db->where('id_users', $id);
        $this->db->delete('users');
    }

    function get_id_karyawan($id)
    {
        $this->db->where('id_users', $id);
        return $this->db->get('users')->row();
    }

    function jumlah_user()
    {
        $this->db->select('*');
        $this->db->from('users');
        return $this->db->get()->num_rows();
    }

    public function update_password($tabel, $where, $data)
    {
        $this->db->where($where);
        $this->db->update($tabel, $data);
    }

    public function upload($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function getDataImage()
    {
        return $this->db->get('users')->result_array();
    }

    public function update_gambar($tabel, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($tabel, $data);
    }
}
