<?php

class Kerusakan_model extends CI_model
{
    public function getKode()
    {
        $this->db->select_max('kode_kerusakan', 'kode');
        $query = $this->db->get('kerusakan')->row_array();

        $data = $query['kode'];
        $noUrut = (int) substr($data, 1, 2);
        $noUrut++;

        $kode = 'K' . sprintf('%02s', $noUrut);
        return $kode;
    }

    public function getKerusakan()
    {
        return $this->db->get('kerusakan')->result_array();
    }

    public function getKerusakanId($id)
    {
        return $this->db->get_where('kerusakan', array('id_kerusakan' => $id))->row_array();
    }

    public function insert()
    {
        $data = [
            'kode_kerusakan' => $this->input->post('kode'),
            'kerusakan' => $this->input->post('kerusakan'),
            'solusi' => $this->input->post('solusi')
        ];

        $this->db->insert('kerusakan', $data);

        $this->db->select_max('id_kerusakan', 'id');
        $id = $this->db->get('kerusakan')->row_array();

        $check = $this->input->post('gejala');
        foreach ($check as $object) {
            $data = [
                'kerusakan_id' => $id['id'],
                'gejala_id' => $object
            ];
            $this->db->insert('relasi', $data);
        }
    }

    public function update($id)
    {
        $data = [
            'kerusakan' => $this->input->post('kerusakan'),
            'solusi' => $this->input->post('solusi')
        ];

        $this->db->update('kerusakan', $data, ['id_kerusakan' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('kerusakan', ['id_kerusakan' => $id]);
        $this->db->delete('relasi', ['kerusakan_id' => $id]);
    }
}
