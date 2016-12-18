<?php
class Err404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $this->load->view('errors/html/error_404');//loading in my template
    }
}
?>