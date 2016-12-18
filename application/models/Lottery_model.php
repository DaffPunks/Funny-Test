<?php

class Lottery_model extends CI_Model
{

    private $estimated_amount = 5;
    private $today_measur_error = 80;
    private $past_measur_error = 10;

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

    public function testLuck()
    {
        if($this->getCurrentDay()["have_winner"]) {

            return false;

        } else {

            $chance = 0;

            $last_day = $this->getLastDay(0);
            if ($last_day["id"] == 1) {
                $chance = $this->estimated_amount;
            } else {
                for($i = $last_day["id"] - 1; $i >= 1; $i--) {
                    $chance += $this->getVisitors($i);
                }

                $chance = $chance / ($last_day["id"] - 1);
            }

            if($last_day["id"] == $this->getCurrentDay()["id"]) {
                $chance = $chance * $this->today_measur_error / 100;
            } else {
                $chance = $chance * $this->past_measur_error / 100;
            }

            $number = rand(1, $chance);

            if($number == 1) {
                return $last_day["id"];
            } else {
                return false;
            }
        }
    }

    /** Get last day, where no winner. Recursive */
    private function getLastDay($days_offset)
    {
        $first_day = $this->db->get_where('lottery', array('date' => Carbon\Carbon::now()->addDays($days_offset)->format("Y-m-d")))->row_array();
        $second_day = $this->db->get_where('lottery', array('date' => Carbon\Carbon::now()->addDays(-($days_offset + 1))->format("Y-m-d")))->row_array();

        if (!$second_day["have_winner"] && !empty($second_day)) {
            $this->getLastDay($days_offset + 1);
        } else {
            return $first_day;
        }
    }

    private function getVisitors($day)
    {
        return $this->db->get_where('lottery', array('id' => $day))->row_array()["visitors"];
    }

    private function getCurrentDay() {
        return $this->db->get_where('lottery', array('date' => Carbon\Carbon::now()->format("Y-m-d")))->row_array();
    }

    public function increaseVisitors() {
        $today = $this->db->get_where('lottery', array('date' => Carbon\Carbon::now()->format("Y-m-d")))->row_array();

        $id = $today["id"];
        $visitors = $today["visitors"] + 1;


        $data = array(
            'visitors' => $visitors
        );

        $this->db->where('id', $id);
        $this->db->update('lottery', $data);
    }

    public function checkWinner($id, $user_id) {

        $data = array(
            'user_id' => $user_id,
            'have_winner' => true
        );

        $this->db->where('id', $id);
        $this->db->update('lottery', $data);

    }

    public function getAllDays() {
        $query = $this->db->get('lottery');
        return $query->result_array();
    }
}