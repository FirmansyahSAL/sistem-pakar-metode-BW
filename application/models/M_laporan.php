<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    function get_periode_laporan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('detail_tiket');
        $this->db->join('tiket', 'detail_tiket.tiket_id = tiket.id_tiket', 'left');
        $this->db->where('waktu_tanggapan >=',  $tgl_awal);
        $this->db->where('waktu_tanggapan <=',  $tgl_akhir);

        return $this->db->get();
    }
}
