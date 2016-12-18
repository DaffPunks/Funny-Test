<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('html');
        $this->load->helper('url');

        $this->load->library('parser');

        $this->load->model('user_model');
        $this->load->model('lottery_model');
    }

    public function result()
    {

        $this->lottery_model->increaseVisitors();

        //Take answers and check type
        $answers = $this->input->post("answers");
        $type = $this->checkAnswers($answers);

        $win_day = $this->lottery_model->testLuck();

        $user_id = $this->user_model->create_user($type, (bool)$win_day);

        $data["isWinner"] = $win_day;

        if($win_day) {

            $this->lottery_model->checkWinner($win_day, $user_id);
        }


        if($type == 3) {
            $this->load->view('type_positive', $data);
        } else if ($type == 2) {
            $this->load->view('type_neutral', $data);
        } else if ($type == 1) {
            $this->load->view('type_negative', $data);
        } else {
            echo "Something goes wrong";
            die();
        }
        $this->load->view('lottery_modal', $data);
        $this->load->view('body_close');

    }

    private function checkAnswers($answers) {
        $step = count($answers) / 4;
        $count = 0;

        if (count($answers) )

        foreach ($answers as $answer) {
            if($answer == "Y"){
                $count++;
            }
        }

        if ($count <= $step) {
            return 1;
        } else if ($count > $step && $count < $step * 3) {
            return 2;
        } else {
            return 3;
        }
    }

}
