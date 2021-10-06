<?php

class User_model extends CI_model
{
    public function getHasil($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('kerusakan', 'kerusakan.kode_kerusakan = user.kerusakan_kode');
        $this->db->where('user.id', $id);
        return $this->db->get()->row_array();
    }

    public function getId()
    {
        $this->db->select_max('id', 'id');
        $query = $this->db->get('user')->row_array();

        $data = $query['id'];
        $kode = (int) substr($data, 0);
        $kode++;

        return $kode;
    }

    public function insert()
    {
        $id = $this->getId();

        $data = [
            'id' => $this->input->post('id'),
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'merek' => $this->input->post('merek'),
            'seri' => $this->input->post('seri')
        ];

        $this->db->insert('user', $data);
    }

    public function update($id, $kode)
    {
        $data = [
            'kerusakan_kode' => $kode
        ];

        $this->db->update('user', $data, ['id' => $id]);
    }
}
