<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('url');

        $this->load->model('user_model');
        $this->load->model('lottery_model');
    }

    public function main_view()
    {
        $this->load->view('admin/login_view');
    }

    public function admin_panel() {
        $name = $this->input->post("login");
        $pass = $this->input->post("password");

        if(strtolower($name) == "admin" && $pass == "123") {

            $data["days"] = $this->lottery_model->getAllDays();
            $data["users"] = $this->user_model->get_users();

            $this->load->view('admin/admin_panel_view', $data);
        } else {
            redirect("/login");
        }
    }

}
