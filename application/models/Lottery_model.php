<?php

class Lottery_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function create_day($date)
    {
        $data = array(
            'date' => $date
        );

        return $this->db->insert('lottery', $data);
    }
}