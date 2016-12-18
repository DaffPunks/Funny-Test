<?php

class Tools extends CI_Controller
{

    public function migrate()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        }
    }

    public function start_contest()
    {
        $this->load->model('lottery_model');

        for ($i = 0; $i < 7; $i++) {
            $this->lottery_model->create_day(\Carbon\Carbon::now()->addDays($i)->format("Y-m-d"));
        }


    }
}