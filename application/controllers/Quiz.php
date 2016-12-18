<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller
{

    public function result()
    {
        $this->load->helper('html');
        $this->load->helper('url');

        $rightAnswers = 0;

        $answers = $this->input->post("answers");
        if ($answers[0] == "Y") $rightAnswers++;
        if ($answers[1] == "Y") $rightAnswers++;
        if ($answers[2] == "Y") $rightAnswers++;
        if ($answers[3] == "Y") $rightAnswers++;


        if($rightAnswers >= 4) {
            $this->load->view('type_positive');
        } else if ($rightAnswers < 4 && $rightAnswers > 1) {
            $this->load->view('type_neutral');
        } else if ($rightAnswers <= 1) {
            $this->load->view('type_negative');
        }

    }

}
