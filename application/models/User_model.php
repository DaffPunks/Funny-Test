<?php

class User_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result_array();

    }

    public function create_user($type, $is_winner)
    {
        $data = array(
            'person_type' => $type,
            'is_winner' => $is_winner
        );

        return $this->db->insert('users', $data);
    }
}