<?php

class Motor_model extends CI_model
{
    public function getMerek()
    {
        return $this->db->get('merek')->result_array();
    }

    public function getSeri()
    {
        return $this->db->get('seri')->result_array();
    }

    public function insert($parameter)
    {
        if ($parameter == 1) {
        } else {
        }
    }
}
